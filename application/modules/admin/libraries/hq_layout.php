<?php
Class HQ_Layout {

    var $ci;
    var $data;
    var $layout;
    var $layout_css;
    var $layout_options;
    var $structure;
    var $views;
    
    function HQ_Layout(){
        $this->__construct();
    }

    function __construct(){
        $this->ci =& get_instance();
        $this->layout_options = array(
            '6col' => array('header','menu','left','content','right','footer'),
            '5col' => array('header','menu','left','content','footer'),
            '4col' => array('header','menu','content','footer'),
            '3col' => array('header','content','footer'),
            '2col' => array('header','left','content','footer'),
            '1col' => array('header','content','footer'),
            '0col' => array('content')
        );

        // Set charset using charset value from config.php
        $this->set_meta(array('Content-Type' => 'text/html; charset='.$this->ci->config->item('charset')), 'http-equiv');
    }

    function set_layout($views = array(), $layout = ''){
        // Setup layout based on value passed in, or config item
        $this->layout = ($layout !== '') ? $layout : $this->ci->config->item('layout') ;

        // Setup array of views passed in and prepare it to be merged with views from $this->layout_options
        if(!empty($views)){
            $local_views = array();

            foreach($views as $key => $value){
                if(is_int($key)){
                    $local_views[$value] = $value;
                }
                else{
                    $local_views[$key] = $value;
                }
            }

            // Build $this->views by cycling through the options in $this->layout_option
            // If a value exists in $local_views, it is used instead of the default
            foreach($this->layout_options[$this->layout] as $view){
                if(isset($local_views[$view])){
                    $this->views[$view] = $local_views[$view];
                }
                else{
                    $this->views[$view] = $view;
                }
            }
        }
        else{
            $this->views = $this->layout_options[$this->layout];
        }
    }

    function set_layout_css($layout_css){
        $this->layout_css = $layout_css;
    }

    function set_doctype($doctype = 'transitional'){
        switch($doctype){
            case 'transitional':
                $this->structure['doctype'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
            break;

            case 'strict':
                $this->structure['doctype'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
            break;
            
            case 'html5':
                $this->structure['doctype'] = '<!DOCTYPE html>';
            break;

            default:
                $this->structure['doctype'] = $doctype;
            break;
        }
    }

    function set_title($title){
        $this->structure['title'] = '<title>'.$title.'</title>';
    }

    function add_css($css,$media = 'screen'){
        if(!is_array($css)){
            $css = array($css);
        }

        foreach($css as $css_file){
            $this->structure['css'][$media][] = $css_file;
        }
    }

    function get_css(){
        // Store css files in a local variable
        if(isset($this->structure['css'])){
            $local_css = $this->structure['css'];
            unset($this->structure['css']);
        }

         // Only use layout_css from hq_config if $this->layout_css has not been set
        if(!isset($this->layout_css) && $this->ci->config->item('layout')){
            $this->set_layout_css($this->ci->config->item('layout_css'));
        }

        $this->add_css($this->layout_css);

        // Always use standard css from hq_config if it's set
        if($this->ci->config->item('standard_css')){
            $this->add_css($this->ci->config->item('standard_css'),'screen');
        }

        // Always use standard print css from hq_config if it's set
        if($this->ci->config->item('standard_print_css')){
            $this->add_css($this->ci->config->item('standard_print_css'),'print');
        }

        // If print stylesheets have been defined, use them
        if(isset($this->structure['print_css'])){
            if(!is_array($this->structure['print_css'])){
                $this->structure['print_css'] = array($this->structure['print_css']);
            }

            foreach($this->structure['print_css'] as $css_file){
               $this->add_css($this->structure['print_css'],'print');
            }
        }

        // If there are css files defined locally, add them
        if(isset($local_css)){
            foreach($local_css as $media => $list){
                foreach($list as $css_file){
                    $this->add_css($css_file,$media);
                }
            }
        }
		//echo "<pre>";print_r($this->structure['css']);die;
        $this->structure['css_tags'] = array();
        foreach($this->structure['css'] as $media => $css){
            //$css_files = trim(implode(',', $files),',');
			foreach($css as $files){
				if(isset($files) && !empty($files)){
					//$this->structure['css_tags'][] = '<link type="text/css" rel="stylesheet" media="'.$media.'" href="'.SITEURL.'assets/'.$files.'" />';
					$this->structure['css_tags'][] = '<link type="text/css" rel="stylesheet" media="'.$media.'" href="/assets/'.$files.'" />';
				}
			}
		}                
    }

    function add_js($js){
        $this->structure['js'][] = $js;
    }

    function get_js(){
		
        // Get JS defined in hq_config
        $global_js = $this->ci->config->item('standard_js');
		
        // Add JS defined locally
        $local_js = $this->structure['js'];
		
        $js = array();
        if( !empty($local_js) && trim($local_js[0]) != ''){
            $js = array_merge($global_js,$local_js);
            $js_files = implode(',', $js);
        } else {
            $js = $global_js;
            $js_files = implode(',', $global_js);
        }      
        
        $this->structure['js_tag'] = "";
        if(isset($js)){
            $js_files = trim(implode(',', $js),',');			
			$js_files = explode(",",$js_files);		
			
			foreach($js_files as $key => $jFile){				
				if(isset($jFile) && !empty($jFile)){
					//$this->structure['js_tag'] .= '<script type="text/javascript" src="'.SITEURL.'assets/'.$jFile.'"></script>';
					$this->structure['js_tag'] .= '<script type="text/javascript" src="/assets/'.$jFile.'"></script>';
				}
			}            			
        }        
    }

    function set_meta($meta,$type = 'name'){
        if(!is_array($meta)){
            $meta = array($meta);
        }

        foreach($meta as $name => $content){
            $this->structure['meta'][] = '<meta '.$type.'="'.$name.'" content="'.$content.'" />';
        }
    }

    function set_misc_head($code) {
        $this->structure['misc_head'] = $code;
    }

    function set_data($data){
        $this->ci->load->vars($data);
    }

    function set_structure($structure){
        if(isset($structure['keywords'])){
            $this->set_meta(array('keywords' => $structure['keywords']));
        }

        if(isset($structure['description'])){
             $this->set_meta(array('description' => $structure['description']));
        }

        if(isset($structure['print_css'])){
             $this->add_css($structure['print_css'],'print');
        }

        foreach($structure as $var => $value){
            if($var == 'css' || $var == 'js'){
                $func_name_prefix = 'add';
            }
            else{
                $func_name_prefix = 'set';
            }

            $func_name = $func_name_prefix.'_'.$var;
            if(method_exists($this, $func_name)){
                $this->$func_name($value);
            }
            else{
                if(isset($this->$var)){
                    $this->structure[$var] = $value;
                }
            }
        }
    }

    function render(){
        // Always use the doctype from hq_config
        $this->set_doctype($this->ci->config->item('doctype'));

        $this->get_css();

        // Always use standard settings for these if it has been set
        if($this->ci->config->item('standard_meta')){
            $this->set_meta($this->ci->config->item('standard_meta'));
        }

        $this->get_js();

        // Set misc head using both global and local settings
        $gloabl_misc_head = $this->ci->config->item('standard_misc_head');
        $local_misc_head = isset($this->structure['misc_head']) ? $this->structure['misc_head'] : '';
        $this->set_misc_head($gloabl_misc_head.$local_misc_head);

		$structureFile = $this->ci->config->item('structureFile');
        // Always load structure view
        $this->ci->load->view($structureFile,$this->structure);

        // Load all views
        foreach($this->views as $key => $value) {
            if(is_int($key)){
                $this->ci->load->view($value);
            }
            else {
                if(!is_array($value)){
                    $value = array($value);
                }

                foreach($value as $view){
                    $this->ci->load->view($view);
                }
            }
        }
    }
}
?>
