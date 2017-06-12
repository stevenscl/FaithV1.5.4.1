<?php get_header(); ?>
<?php include( TEMPLATEPATH . '/slide.php' ); ?>
<!-- Container begin -->
<div class="inner container container-home">
	<section class="row-fluid row-fluid-home">
		<div class="column-fluid">
			<div class="content">
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('分频栏目一') ) : ?><?php endif; ?>
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('分频栏目二') ) : ?><?php endif; ?>
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('分频栏目三') ) : ?><?php endif; ?>
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('分频栏目四') ) : ?><?php endif; ?>
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('分频栏目五') ) : ?><?php endif; ?>
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('分频栏目六') ) : ?><?php endif; ?>
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('滚动栏目一') ) : ?><?php endif; ?>
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('滚动栏目二') ) : ?><?php endif; ?>
			</div>
		</div>
		<div class="homebar">
				<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('主页侧边栏') ) : ?><?php endif; ?>
		</div>
	</section>
</div>
<!-- Container end -->
<?php get_footer(); ?>

