#Code Patterns

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
					<time class="entry-date" datetime="2008-10-17T04:33:51+00:00">
						17 October, 2008
					</time>
			</div>
			<div class="vcard">
				<a class="url fn n" href="#" rel="author">Author</a>
			</div>		
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<div class="entry-content">
		Content
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<span class="tag-links">
			<a href="#" rel="tag">tag</a>
			<a href="#" rel="tag">tag</a>
		</span>
	</footer>
</article>
```