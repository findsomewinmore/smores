#Code Pattern Library

This document lists and explains various code patterns that should be used throughout a Wordpress website. The aim is to provide a reference for creating semantic, search engine friendly markup using [microformats](http://microformats.org/)


##Post Entry

```html
<article id="post-<?php the_ID() ?>" class="post hentry post-<?php the_ID() ?> post-type-<?php echo get_post_type() ?> category-<?php the_category() ?>">
	<header class="entry-header">
		<div class="entry-meta">
			<span class="category-links">
				<a href="#" rel="tag"><?php the_category() ?></a>
			</span>
		</div>
		<h1 class="entry-title">
			<!-- Optional:
				 <a href="<?php the_permalink() ?>" rel="bookmark">
				 	<?php the_title() ?>
				 </a>
			-->
			<?php the_title() ?>
		</h1>
		<div class="entry-meta">
			<div class="entry-date">
					<time class="entry-date" datetime="<?php the_time('c') ?>">
						<!--
							Time Format: November 6, 2010 @ 12:50 AM
						-->
						<?php the_time('F j, Y @ g:i A') ?>
					</time>
			</div>
			<div class="vcard">
				<a class="url fn n" href="<?php the_author_link() ?>" target="_blank" rel="author"><?php the_author() ?></a>
			</div>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content() ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<span class="tag-links">
			<?php
				$post_tags = get_the_tags();
				foreach($post_tags as $tag){
					echo '<a href="'. bloginfo('url') .'/?tag='. $tag->slug .'" rel="tag">'. $tag->name .'</a> ';
				}
			?>
		</span>
	</footer>
</article>
```
