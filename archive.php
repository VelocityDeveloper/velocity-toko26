<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">

                <div style="font-size: 0.8rem;">
                    <?php echo justg_breadcrumb(); ?>
                </div>

                <?php

                if (have_posts()) {
                ?>

                    <header class="page-header block-primary">
                        <?php
                        the_archive_title('<h1 class="page-title color-theme text-uppercase">', '</h1>');
                        the_archive_description('<div class="taxonomy-description border fw-light fst-italic bg-light d-block p-3 pb-1 mb-3"><small>', '</small></div>');
                        ?>
                    </header><!-- .page-header -->

                    <?php
                    // Start the loop.
                    $postcount = 1;
                    while (have_posts()) {
                        the_post();
                    ?>
                        <article <?php post_class('mb-4'); ?> id="post-<?php the_ID(); ?>">

                            <div class="card p-3">

                                <?php if (has_post_thumbnail($post->ID)) : ?>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <a class="d-block" href="<?php echo get_the_permalink(); ?>">
                                                <div class="ratio ratio-1x1 bg-light overflow-hidden">
                                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class' => 'w-100')); ?>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-md-8">
                                        <?php endif; ?>

                                        <?php
                                        the_title(
                                            sprintf('<h2 class="fs-5 fw-bold mb-md-2"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                            '</a></h2>'
                                        );
                                        ?>

                                        <div>
                                            <?php echo vd_limit_text(strip_tags(get_the_excerpt()), 25); ?>
                                        </div>

                                        <?php if (has_post_thumbnail($post->ID)) : ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </article>

                <?php
                        $postcount++;
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
                <!-- Display the pagination component. -->
                <?php justg_pagination(); ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
