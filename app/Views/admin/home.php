<?php
/**
 * App > Views > Admin > Home.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

use HVSFW\Admin\Inc\Helper;
use HVSFW\Inc\Plugins;

defined( 'ABSPATH' ) || exit;
?>

<main class="hd-app">
    <div class="hd-home">
        <div class="hd-home__container">
            <div class="hd-home__banner">
                <div class="hd-txt-center">
                    <p class="hd-home__developer">
                        <span><?php echo __( 'HANDCRAFTED BY ', 'handy-variation-swatches' ); ?></span>
                        <a href="#" target="_blank">
                            <?php echo __( 'MAFEL JOHN CAHUCOM', 'handy-variation-swatches' ); ?>
                        </a>
                    </p>
                    <h1 class="hd-home__title">
                        <?php echo __( 'Handy Tools', 'handy-variation-swatches' ); ?>
                    </h1>
                    <p class="hd-home__description">
                        <?php echo __( 'Handy Tools offers a suite of free, easy-to-use WordPress plugins crafted to streamline the development and management of your WooCommerce stores.', 'handy-variation-swatches' ); ?>
                    </p>
                </div>
            </div>
            <div class="hd-home-plugins">
                <?php foreach ( Plugins::collections() as $plugin ) : ?>
                    <div class="hd-home-plugin">
                        <div class="hd-home-plugin__content">
                            <div class="hd-home-plugin__header">
                                <div class="hd-home-col">
                                    <div class="hd-home-col__left">
                                        <?php if ( ! empty( $plugin['slug'] ) ) : ?>
                                            <img class="hd-home-plugin__icon" src="<?php echo esc_url( Helper::get_resource_src( 'images/' . $plugin['slug'] . '.svg' ) ); ?>" alt="<?php echo esc_attr( $plugin['name'] ); ?>" title="<?php echo esc_attr( $plugin['name'] ); ?>">
                                        <?php endif ?>
                                    </div>
                                    <div class="hd-home-col__right">
                                        <?php if ( ! empty( $plugin['name'] ) ) : ?>
                                            <h3 class="hd-home-plugin__name">
                                                <a href="<?php echo esc_url( $plugin['website'] ); ?>" target="_blank">
                                                    <?php echo esc_html( $plugin['name'] ); ?>
                                                </a>
                                            </h3>
                                        <?php endif; ?>
                                        <?php if ( Plugins::is_installed( $plugin['slug'] ) ) : ?>
                                            <p class="hd-home-plugin__status" data-state="installed">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                                </svg>
                                                <?php echo __( 'Installed', 'handy-variation-swatches' ); ?>
                                            </p>
                                        <?php else : ?>
                                            <p class="hd-home-plugin__status" data-state="not-installed">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                </svg>
                                                <?php echo __( 'Not Installed', 'handy-variation-swatches' ); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="hd-home-plugin__body">
                                <?php if ( ! empty( $plugin['description'] ) ) : ?>
                                    <p class="hd-home-plugin__description">
                                        <?php echo esc_html( $plugin['description'] ); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hd-home-plugin__footer">
                            <div class="hd-home-plugin__tools">
                                <a class="hd-home-plugin__tool" href="https://wordpress.org/download/" target="_blank" aria-label="<?php echo __( 'WordPress', 'handy-variation-swatches' ); ?>" title="<?php echo __( 'WordPress', 'handy-variation-swatches' ); ?>">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_39_78)">
                                            <path d="M0.0180359 8.99954C0.0180359 12.5548 2.08382 15.6276 5.08075 17.0833L0.796114 5.34431C0.297844 6.46098 0.0180359 7.69781 0.0180359 8.99954ZM15.0636 8.54652C15.0636 7.436 14.6649 6.66756 14.3232 6.06976C13.868 5.32941 13.4412 4.7031 13.4412 3.9632C13.4412 3.13731 14.0671 2.3689 14.9491 2.3689C14.9895 2.3689 15.0272 2.37371 15.0654 2.37589C13.468 0.911883 11.3386 0.0175781 9 0.0175781C5.86185 0.0175781 3.10134 1.62766 1.4952 4.06579C1.70617 4.07282 1.90484 4.07721 2.07327 4.07721C3.01275 4.07721 4.46755 3.96316 4.46755 3.96316C4.9513 3.93423 5.00878 4.64562 4.525 4.70306C4.525 4.70306 4.03815 4.76009 3.49692 4.78814L6.76793 14.5175L8.73327 8.62235L7.33416 4.78814C6.84995 4.76009 6.39204 4.70306 6.39204 4.70306C5.90825 4.67409 5.96486 3.9342 6.44906 3.96316C6.44906 3.96316 7.93195 4.07721 8.81483 4.07721C9.75385 4.07721 11.2087 3.96316 11.2087 3.96316C11.6929 3.93423 11.7499 4.64562 11.2657 4.70306C11.2657 4.70306 10.7784 4.76009 10.2381 4.78814L13.4841 14.4434L14.3802 11.4504C14.8355 10.2829 15.0636 9.31489 15.0636 8.54652ZM9.15789 9.78507L6.46274 17.6167C7.26757 17.853 8.11888 17.9824 9 17.9824C10.0465 17.9824 11.0496 17.8017 11.9829 17.4732C11.9592 17.4346 11.9368 17.3938 11.9189 17.3491L9.15789 9.78507ZM16.882 4.69079C16.9206 4.97675 16.9425 5.28377 16.9425 5.61403C16.9425 6.52542 16.7715 7.55044 16.2596 8.83114L13.5162 16.7631C16.1864 15.2061 17.982 12.3136 17.982 8.99954C17.982 7.43815 17.5829 5.96974 16.882 4.69079Z" fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_39_78">
                                                <rect width="18" height="18" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span>
                                        <?php echo __( '4.8.14+', 'handy-variation-swatches' ); ?>
                                    </span>
                                </a>
                                <a class="hd-home-plugin__tool" href="https://woocommerce.com/" target="_blank" aria-label="<?php echo __( 'WooCommerce', 'handy-variation-swatches' ); ?>" title="<?php echo __( 'WooCommerce', 'handy-variation-swatches' ); ?>">
                                    <svg width="46" height="12" viewBox="0 0 46 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_39_421)">
                                            <path d="M5.86903 12C7.20997 12 8.28855 11.3301 9.10477 9.79463L10.9121 6.3912V9.27629C10.9121 10.978 12.0053 11.9951 13.696 11.9951C15.0224 11.9951 15.9989 11.4132 16.9463 9.78974L21.1101 2.71394C22.0234 1.16382 21.3773 -0.00488281 19.3707 -0.00488281C18.2921 -0.00488281 17.5974 0.347195 16.9658 1.53057L14.0993 6.95355V2.13693C14.0993 0.699274 13.4191 7.1628e-06 12.1608 7.1628e-06C11.1648 7.1628e-06 10.368 0.435215 9.75581 1.63326L7.0545 6.95844V2.18583C7.0545 0.650374 6.4229 7.1628e-06 4.89734 7.1628e-06H1.77334C0.597592 7.1628e-06 0 0.552574 0 1.56969C0 2.5868 0.631601 3.1736 1.77334 3.1736H3.05112V9.26651C3.05112 10.9878 4.19772 12.0049 5.86903 12.0049V12Z" fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M27.1977 0C23.7968 0 21.1927 2.55257 21.1927 6.00978C21.1927 9.46699 23.8114 12 27.1977 12C30.5841 12 33.1688 9.44743 33.1834 6.00978C33.1834 2.55257 30.5792 0 27.1977 0ZM27.1977 8.31296C25.9199 8.31296 25.0406 7.34474 25.0406 6.00978C25.0406 4.67482 25.9199 3.69193 27.1977 3.69193C28.4755 3.69193 29.3549 4.67482 29.3549 6.00978C29.3549 7.34474 28.4949 8.31296 27.1977 8.31296Z" fill="currentColor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M34.0287 6.00978C34.0287 2.55257 36.6329 0 40.0144 0C43.3959 0 46 2.57213 46 6.00978C46 9.44743 43.3959 12 40.0144 12C36.6329 12 34.0287 9.4621 34.0287 6.00978ZM37.8766 6.00978C37.8766 7.34474 38.722 8.31296 40.0144 8.31296C41.3067 8.31296 42.1715 7.34474 42.1715 6.00978C42.1715 4.67482 41.2921 3.69193 40.0144 3.69193C38.7366 3.69193 37.8766 4.67482 37.8766 6.00978Z" fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_39_421">
                                                <rect width="46" height="12" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span>
                                        <?php echo __( '4.0.0+', 'handy-variation-swatches' ); ?>
                                    </span>
                                </a>
                                <a class="hd-home-plugin__tool" href="https://www.php.net/" target="_blank" aria-label="<?php echo __( 'PHP', 'handy-variation-swatches' ); ?>" title="<?php echo __( 'PHP', 'handy-variation-swatches' ); ?>">
                                    <svg width="33" height="16" viewBox="0 0 33 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.38718 10.3075C6.37059 10.3075 7.10484 10.1201 7.57015 9.75194C8.0305 9.38716 8.3473 8.75633 8.51395 7.8745C8.66905 7.05124 8.60965 6.47563 8.33905 6.16607C8.06185 5.84982 7.46125 5.68751 6.55374 5.68751H4.97963L4.10842 10.3075H5.38718ZM0.244093 15.9983C0.20794 15.9983 0.172259 15.99 0.139697 15.9741C0.107135 15.9581 0.0785261 15.935 0.055992 15.9063C0.0327875 15.8774 0.0161686 15.8437 0.00732564 15.8075C-0.00151736 15.7714 -0.00236553 15.7337 0.00484175 15.6971L2.31486 3.45534C2.32554 3.39832 2.35538 3.34681 2.39931 3.30958C2.44323 3.27236 2.49852 3.25173 2.55576 3.2512H7.53384C9.09806 3.2512 10.263 3.6896 10.9956 4.55135C11.7315 5.41979 11.9592 6.63125 11.6704 8.15729C11.5612 8.75746 11.3591 9.33633 11.0715 9.87241C10.791 10.3895 10.4197 10.868 9.96926 11.2947C9.4543 11.7998 8.83484 12.1822 8.1559 12.4141C7.50414 12.6333 6.66594 12.7438 5.66438 12.7438H3.64972L3.07386 15.7959C3.06324 15.8526 3.03364 15.9039 2.99005 15.9411C2.94647 15.9783 2.89157 15.9991 2.83461 16L0.244093 15.9983ZM17.8085 12.7438C17.7726 12.7437 17.7371 12.7354 17.7048 12.7195C17.6725 12.7035 17.6442 12.6804 17.622 12.6517C17.5993 12.6229 17.583 12.5894 17.5742 12.5536C17.5654 12.5178 17.5642 12.4805 17.5709 12.4443L18.579 7.02782C18.6747 6.51245 18.6516 6.14265 18.513 5.98703C18.4289 5.89165 18.1731 5.73102 17.4174 5.73102H15.5892L14.3203 12.5413C14.3104 12.5981 14.2812 12.6495 14.2378 12.6868C14.1944 12.724 14.1396 12.7448 14.0827 12.7455H11.55C11.5141 12.7454 11.4786 12.7371 11.4463 12.7211C11.414 12.7052 11.3857 12.6821 11.3635 12.6534C11.3408 12.6246 11.3245 12.5911 11.3157 12.5553C11.3069 12.5195 11.3058 12.4822 11.3124 12.4459L13.5927 0.204142C13.6027 0.147389 13.6319 0.0959459 13.6752 0.0586806C13.7186 0.0214153 13.7734 0.000662208 13.8303 0H16.3664C16.439 0 16.5066 0.0334663 16.5528 0.0920315C16.599 0.150597 16.6172 0.225895 16.604 0.301193L16.0545 3.25622H18.0213C19.5195 3.25622 20.5343 3.53232 21.1266 4.09789C21.7289 4.67685 21.917 5.6005 21.686 6.84543L20.625 12.543C20.6151 12.5997 20.5859 12.6512 20.5425 12.6884C20.4991 12.7257 20.4443 12.7465 20.3874 12.7471H17.8085V12.7438ZM26.3506 10.3075C27.3719 10.3075 28.1342 10.1201 28.6177 9.75194C29.0946 9.38716 29.4246 8.75633 29.5978 7.8745C29.7595 7.05124 29.6968 6.47563 29.4147 6.16607C29.1259 5.84982 28.5022 5.68751 27.56 5.68751H25.9282L25.0223 10.3075H26.3506ZM21.0111 15.9983C20.9738 15.9984 20.9369 15.9901 20.903 15.9742C20.8691 15.9584 20.839 15.9352 20.8148 15.9063C20.7911 15.8777 20.774 15.844 20.7649 15.8078C20.7558 15.7716 20.7548 15.7338 20.762 15.6971L23.1611 3.45534C23.1729 3.39734 23.2042 3.34529 23.2497 3.30807C23.2951 3.27085 23.3519 3.25075 23.4103 3.2512H28.5797C30.205 3.2512 31.4145 3.6896 32.1735 4.55135C32.9374 5.41979 33.1734 6.63125 32.8747 8.15729C32.7526 8.77808 32.5447 9.35537 32.2527 9.87074C31.9623 10.3878 31.5762 10.8663 31.1092 11.293C30.5482 11.8134 29.9146 12.1899 29.2266 12.4125C28.5484 12.6317 27.6788 12.7421 26.6393 12.7421H24.5455L23.9482 15.7925C23.9363 15.8505 23.905 15.9026 23.8596 15.9398C23.8142 15.977 23.7574 15.9971 23.699 15.9967L21.0111 15.9983Z" fill="currentColor"/>
                                    </svg>
                                    <span>
                                        <?php echo __( '7.4.8+', 'handy-variation-swatches' ); ?>
                                    </span>
                                </a>
                            </div>
                            <div class="hd-home-plugin__actions">
                                <?php if ( Plugins::is_installed( $plugin['slug'] ) ) : ?>
                                    <?php if ( Plugins::is_active( $plugin['slug'] ) ) : ?>
                                        <a class="hd-btn" href="<?php echo esc_url( admin_url( 'admin.php?page=' . $plugin['prefix'] ) ); ?>">
                                            <?php echo __( 'Dashboard', 'handy-variation-swatches' ); ?>
                                        </a>
                                    <?php else : ?>
                                        <a class="hd-btn" href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>">
                                            <?php echo __( 'Activate', 'handy-variation-swatches' ); ?>
                                        </a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a class="hd-btn" href="<?php echo esc_url( $plugin['download'] ); ?>" target="_blank">
                                        <?php echo __( 'Download', 'handy-variation-swatches' ); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
