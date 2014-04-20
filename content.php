<?php
/**
 * @package classic_blogging
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php classic_blogging_posted_on(); ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'classic_blogging' ), __( '1 Comment', 'classic_blogging' ), __( '% Comments', 'classic_blogging' ) ); ?></span>
		<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() || is_home() || is_archive() ) : // Display Excerpts for Search, Homepage and Archive ?>
	<div class="entry-summary">
	<!-- Adds the 140x140 thumbnail/featured image -->
		<div class="excerpt-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			<?php the_post_thumbnail('excerpt-thumbnail', 'class=alignleft'); ?>
			</a>
		</div>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
	<!-- Adds 140x140 featured image to single post view -->
<div class="excerpt-thumb">
	<?php the_post_thumbnail('excerpt-thumbnail', 'class=alignleft'); ?>
</div>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'classic_blogging' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'classic_blogging' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'classic_blogging' ) );
				if ( $categories_list && classic_blogging_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'classic_blogging' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'classic_blogging' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'classic_blogging' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>


		<?php edit_post_link( __( 'Edit', 'classic_blogging' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
