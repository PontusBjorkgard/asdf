<?php
class OptionsPage {

    public $pageProperties = array();
    public $options = array();

    public function __construct( $args ) {
      $this->pageProperties = $args;
      add_action( 'admin_menu', [$this, 'add_page'] );
    }

    /*
    *   adds Main menu page
    */
    public function add_page() {
      add_menu_page( $this->pageProperties['name'],
                     $this->pageProperties['menu-name'],
                     'manage_options',
                     $this->pageProperties['slug'],
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
    	   <h1> <?php echo $this->pageProperties['name']; ?> </h1>
         <form method="post" action="options.php">
    			<?php
            settings_fields( $this->pageProperties['slug'] );
            do_settings_sections( $this->pageProperties['slug'] );
    				submit_button();
    			 ?>
    		</form>
      </div>
      <?php
    }


    public function create_settings_section() {
      for( $i = 0; $i < sizeof($this->pageProperties['sections']); $i++ ) {
        add_settings_section( $this::slugify($this->pageProperties['sections'][$i]),
                              $this->pageProperties['sections'][$i],
                              [$this, 'section_callback_function'],
                              $this->pageProperties['slug'] );
      }
    }


    public function section_callback_function() {
      //PONT I HESA
        echo '
        <div class="container">
          <div class="row">
            <div class="' . get_option('post-column-quantity') . '">1</div>
            <div class="' . get_option('post-column-quantity') . '">1</div>
            <div class="' . get_option('post-column-quantity') . '">1</div>
            <div class="' . get_option('post-column-quantity') . '">1</div>
          </div>
        </div>
        ';
     }




    public function create_settings() {

      for( $i = 0; $i < sizeof($this->options); $i++ ) {

        register_setting( $this->pageProperties['slug'], $this->options[$i]['option_slug'] );

        add_settings_field( $this->options[$i]['option_slug'],
                            $this->options[$i]['option_name'],
                            [$this, 'asdf_render_fields'],
                            $this->pageProperties['slug'],
                            $this->options[$i]['option_section'],
                            array( 'setting'   => $this->options[$i]['option_slug'],
                                   'type'      => $this->options[$i]['type'],
                                   'choices'    => $this->options[$i]['choices'],
                                   'labels'     => $this->options[$i]['choices_labels'],
                                   'htmlclass' => $this->options[$i]['htmlclass'],
                                   'description' => $this->options[$i]['description']
             ));
      }
    }
    public function hook_create_settings() {
      add_action( 'admin_init', [$this, 'create_settings'] );
    }

    public function asdf_render_fields( $args ) {

    	$setting = $args['setting'];
    	$type    = $args['type'];
      $class   = $args['htmlclass'];
      $choices = $args['choices'];
      $labels  = $args['labels'];
      $description = $args['description'];

    	$value   = get_option( $setting );

      switch( $type ) {

        /*
        *     Radio checkbox fields
        */
        case 'radio':
        case 'checkbox':
              for( $i=0; $i<sizeof($choices); $i++) {
                echo '<input id="' .    $setting .'-option-' . $i . '"
                             class="' . $class . '"
                             type="' .  $type . '"
                             name="' .  $setting . '"
                             value="' . $choices[$i] . '"
                             ' .        ( $value === $choices[$i] ? 'checked' : '') . '  />';
              }
        echo $description;
        break;

        /*
        *     Select field
        */
        case 'select':
              echo '<select name="' . $setting . '">';
              for( $i=0; $i<sizeof($choices); $i++) {
                echo '<option value="' . $choices[$i] . '">' . $labels[$i] . '</option>';
              }
              echo '</select>';
        break;

        /*
        *     Sortable list field
        */
        case 'sortable':
              //Sortable
        echo $description;
        break;

        /*
        *     Default (text, date, color etc. )
        */
        default:
              echo '<input id="' .      $setting . '"
                           class="' .   $class . '"
                           type="' .    $type . '"
                           name="' .    $setting . '"
                           value="' .   $value . '" />';
              echo '<span class="asdf-option-description">' . $description . '</span>';
        break;
        }
      }

//test remve





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
      public $pageProperties;

      public function __construct( $parent, $args ) {
        $this->parent = $parent;
        $this->pageProperties = $args;
        add_action( 'admin_menu', [$this, 'add_submenu_page']);
      }

      public function add_submenu_page() {
        add_submenu_page( $this->parent->pageProperties['slug'],
                          $this->pageProperties['name'],
                          $this->pageProperties['menu-name'],
                          'manage_options',
                          $this->pageProperties['slug'],
                          [$this, 'output_page'] );
                          add_action( 'admin_init', [$this, 'create_settings_section'] );
      }
  }
