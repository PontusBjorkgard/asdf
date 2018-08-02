<?php
class OptionsPage {

    public $args = array();
    public $options = array();

    public function __construct( $args ) {
      $this->args = $args;
      add_action( 'admin_menu', [$this, 'add_page'] );
    }

    /*
    *   adds Main menu page
    */
    public function add_page() {
      add_menu_page( $this->args['name'],
                     $this->args['menu-name'],
                     'manage_options',
                     $this->args['slug'],
                     [$this, 'output_page'],
                     '',
                     3 );
            add_action( 'admin_init', [$this, 'create_settings_section'] );
    }

    /*
    *   add_menu_page callback method. Used to output the html
    */
    public function output_page() {
      ?>
      <div class="pampas-settings">
    	   <h1> <?php echo $this->args['name']; ?> </h1>
         <form method="post" action="options.php">
    			<?php
            settings_fields( $this->args['slug'] );
            do_settings_sections( $this->args['slug'] );
    				submit_button();
    			 ?>
    		</form>
      </div>
      <?php
    }

    
    public function create_settings_section() {
      for( $i = 0; $i < sizeof($this->args['sections']); $i++ ) {
        add_settings_section( $this::slugify($this->args['sections'][$i]), $this->args['sections'][$i], [$this, 'section_callback_function'], $this->args['slug'] );
      }
    }


    public function section_callback_function() { }




    public function create_settings() {

      for( $i = 0; $i < sizeof($this->options); $i++ ) {
        register_setting( $this->args['slug'], $this::slugify($this->options[$i]['option_name']) );
        add_settings_field( $this::slugify($this->options[$i]['option_name']), $this->options[$i]['option_name'], [$this, 'pampas_render_fields_function'], $this->args['slug'], $this->options[$i]['option_section'],
        array( 'setting' => $this::slugify($this->options[$i]['option_name']),
               'type' => $this->options[$i]['type'],
               'values' => $this->options[$i]['values']
             ));
      }
    }
    public function create_settings() {
      add_action( 'admin_init', [$this, 'create_settings'] );
    }

    public function pampas_render_fields_function( $args ) {
    	$setting = $args['setting'];
    	$type = $args['type'];
    	$value = get_option( $setting );

      if( $type == 'radio' || $type == 'checkbox' ) {
        for( $i=0; $i<sizeof($args['values']); $i++) {
          echo '<input type="' . $type . '" name="' . $setting . '" value="' . $args['values'][$i] . '" />';
        }
      }
      else {
        echo '<input type="' . $type . '" name="' . $setting . '" value="' . $value . '" />';
      }

    }



     public static function slugify($text) {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
    }

    return $text;
  }



  }

  class SubPage extends OptionsPage {

      public $parent;
      public $args;

      public function __construct( $parent, $args ) {
        $this->parent = $parent;
        $this->args = $args;
        add_action( 'admin_menu', [$this, 'add_submenu_page']);
      }

      public function add_submenu_page() {
        add_submenu_page( $this->parent->args['slug'],
                          $this->args['name'],
                          $this->args['menu-name'],
                          'manage_options',
                          $this->args['slug'],
                          [$this, 'output_page'] );
                          add_action( 'admin_init', [$this, 'create_settings_section'] );
      }
  }
