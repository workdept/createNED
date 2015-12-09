<div class="media profile">
 
    <?php echo get_avatar( get_the_author_meta( 'ID' ), '70' ); ?>
 
    <div class="bd">
 
        <h4><?php printf( esc_attr__( 'About %s', 'awaken-pro' ), get_the_author() );?></h4>
 
        <p><?php echo wp_kses( get_the_author_meta( 'description' ), null ); ?></p>
 
        <div class="profile-links">

            <ul class="social-links">
                <?php if ( get_the_author_meta( 'twitter' ) != '' )  { ?>
                    <li><a class="sociall" href="https://twitter.com/<?php echo wp_kses( get_the_author_meta( 'twitter' ), null ); ?>" data-toggle="tooltip" data-placement="top" title="<?php printf( esc_attr__( 'Follow %s on Twitter', 'awaken-pro'), get_the_author() ); ?>"><i class="fa fa-twitter-square"></i></a></li>
                <?php } ?>
         
                <?php if ( get_the_author_meta( 'facebook' ) != '' )  { ?>
                    <li><a class="sociall" href="<?php echo esc_url( get_the_author_meta( 'facebook' ) ); ?>" data-toggle="tooltip" data-placement="top" title="<?php printf( esc_attr__( 'Follow %s on Facebook', 'awaken-pro'), get_the_author() ); ?>"><i class="fa fa-facebook-square"></i></a></li>                
                <?php } ?>
         
                <?php if ( get_the_author_meta( 'linkedin' ) != '' )  { ?>
                    <li><a class="sociall" href="<?php echo esc_url( get_the_author_meta( 'linkedin' ) ); ?>" data-toggle="tooltip" data-placement="top" title="<?php printf( esc_attr__( 'Follow %s on LinkedIn', 'awaken-pro'), get_the_author() ); ?>"><i class="fa fa-linkedin-square"></i></a></li>
                <?php } ?>
         
                <?php if ( get_the_author_meta( 'googleplus' ) != '' )  { ?>
                    <li><a class="sociall" href="<?php echo esc_url( get_the_author_meta( 'googleplus' ) ); ?>" data-toggle="tooltip" data-placement="top" title="<?php printf( esc_attr__( 'Follow %s on Google+', 'awaken-pro'), get_the_author() ); ?>"><i class="fa fa-google-plus-square"></i></a></li>
                <?php } ?>
            </ul>
 
            <a class="authorlla" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'awaken-pro' ), get_the_author() ); ?>
            </a>
 
        </div>
 
    </div>
 
</div>