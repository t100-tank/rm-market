<?php $list = $sf_data->getRaw('list'); ?>
                            <?php if (count($list)) { ?>
                                <div class="corner lt"></div>
                                <div class="corner lb"></div>
                                <div class="corner rt"></div>
                                <div class="corner rb"></div>
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php foreach ($list as $key => $slide) { ?>
                                    <li data-target="#promotions" data-slide-to="<?php echo $key ?>"<?php echo ($key == 0) ? ' class="active"': ''; ?>></li>
                                    <?php } ?>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <?php foreach ($list as $key => $slide) { ?>
                                    <div class="item<?php echo ($key == 0) ? ' active': ''; ?>">
                                        <img src="<?php echo $slide->getHtmlImagePath(); ?>" alt="<?php echo str_replace('"', '\'', $slide->getSliderH1()); ?>">
                                        <div class="carousel-caption">
                                            <h3><a href="<?php echo url_for('@promotion?slug='.$slide->getSlug()); ?>"><?php echo $slide->getSliderH1(); ?></a></h3>
                                            <p><?php echo $slide->getSliderText(); ?></p>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                  <span class="icon-prev"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                  <span class="icon-next"></span>
                                </a>

                            <?php } ?>