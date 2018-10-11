

<div class="jumbotron jumbotron-fluid" style="background-image: url('<?php echo asdf_get_option('header-style') == 'featured-img' ?  get_the_post_thumbnail_url() : '' ?>')">

  <div class="container">
    <h1 class="display-4"> <?php single_post_title(); ?></h1>
  </div>
</div>
