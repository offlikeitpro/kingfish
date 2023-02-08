<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arTheme, $arRegion, $bLongHeader, $bColoredHeader;
$arRegions = CMaxRegionality::getRegions();
if($arRegion)
	$bPhone = ($arRegion['PHONES'] ? true : false);
else
	$bPhone = ((int)$arTheme['HEADER_PHONES'] ? true : false);
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
$bLongHeader = true;
$bColoredHeader = true;
?>
<div class="top-block top-block-v1">
	<div class="maxwidth-theme">
		<div class="wrapp_block">
			<div class="row">
				<div class="items-wrapper flexbox flexbox--row justify-content-between">
					<?if($arRegions):?>
						<div class="top-block-item">
							<div class="top-description no-title wicons">
								<?\Aspro\Functions\CAsproMax::showRegionList();?>
							</div>
						</div>
					<?endif;?>
					<div class="top-block-item">
						<div class="phone-block icons">
							<?if($bPhone):?>
								<div class="inline-block">
									<?CMax::ShowHeaderPhones();?>
								</div>
							<?endif?>
							<?$callbackExploded = explode(',', $arTheme['SHOW_CALLBACK']['VALUE']);
							if( in_array('HEADER', $callbackExploded) ):?>
								<div class="inline-block">
									<span class="callback-block animate-load font_upper_xs colored" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback"><?=GetMessage("CALLBACK")?></span>
								</div>
							<?endif;?>
						</div>
					</div>

					<div class="top-block-item addr-block">
                        <div class="phone  with_dropdown">
                            <div class="wrap">
                                <div>
                                    <a href="https://goo.gl/maps/PKFKmPRymwpZRzKW7" target="_blank">

                                    <?=CMax::showIconSvg("addr", SITE_TEMPLATE_PATH."/images/svg/address.svg");?>
                                    </a>
                                    <a rel="nofollow" style="cursor: pointer">Рыболовные снасти и аксессуары</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <div class="wrap srollbar-custom scroll-deferred">
                                    <div class="more_phone"><a rel="nofollow" href="tel:+375293130550">+375 29 313 05 50<img src="/images/A1.png" class="phoneImg" width="20"></a></div>
                                    <div class="more_phone"><a rel="nofollow" href="tel:+375333800550">+375 33 380 05 50<img src="/images/mts.png" class="phoneImg" width="20"></a></div>
                                </div>
                            </div>
                            <?=CMax::showIconSvg("down", SITE_TEMPLATE_PATH."/images/svg/trianglearrow_down.svg");?>
                        </div>
						<div class="phone  with_dropdown" style="padding-left: 2rem;">
                            <div class="wrap">
                                <div>
                                    <a href="https://goo.gl/maps/HvNyKJVhytarAdAw7" target="_blank">
                                        <?=CMax::showIconSvg("addr", SITE_TEMPLATE_PATH."/images/svg/address.svg");?></a>
                                    <a rel="nofollow"  style="cursor: pointer">Салон-сервис техники Yamaha</a>
                                </div>
                            </div>
                                <div class="dropdown" style="width: calc(100% - 2rem);margin-left: 2rem;">
                                    <div class="wrap srollbar-custom scroll-deferred">
                                      <div class="more_phone"><a rel="nofollow" href="tel:+375296231003">+375 29 623 10 03<img src="/images/A1.png" class="phoneImg" width="20"></a></div>
                                      <div class="more_phone"><a rel="nofollow" href="tel:+375173779988">+375 17 377 99 88 <img src="/images/phone.png" class="phoneImg_" width="20"></a></div>
                                    </div>
                                </div>
                                <?=CMax::showIconSvg("down", SITE_TEMPLATE_PATH."/images/svg/trianglearrow_down.svg");?>
                        </div>
					</div>
					<div class="top-block-item show-fixed top-ctrl">
						<div class="personal_wrap">
							<div class="personal top login font_upper">
								<?=CMax::ShowCabinetLink(true, true);?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="header-wrapper header-v7">
	<div class="logo_and_menu-row">
		<div class="logo-row paddings">
			<div class="maxwidth-theme">
				<div class="row">
					<div class="col-md-12">
						<div class="logo-block pull-left floated">
							<div class="logo<?=$logoClass?>">
								<?=CMax::ShowLogo();?>
							</div>
						</div>

						<div class="float_wrapper fix-block pull-left">
							<div class="hidden-sm hidden-xs pull-left">
								<div class="top-description addr">
									<?$APPLICATION->IncludeFile(SITE_DIR."include/top_page/slogan.php", array(), array(
											"MODE" => "html",
											"NAME" => "Text in title",
											"TEMPLATE" => "include_area.php",
										)
									);?>
								</div>
							</div>
						</div>

						<div class="search_wrap pull-left">
							<div class="search-block inner-table-block">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/top_page/search.title.catalog.php",
										"EDIT_TEMPLATE" => "include_area.php",
										'SEARCH_ICON' => 'Y',
									)
								);?>
							</div>
						</div>

						<div class="right-icons pull-right wb">
							<div class="pull-right">
								<?=CMax::ShowBasketWithCompareLink('', 'big', '', 'wrap_icon wrap_basket baskets');?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><?// class=logo-row?>
	</div>

	<div class="menu-row middle-block bg<?=strtolower($arTheme["MENU_COLOR"]["VALUE"]);?>">
		<div class="maxwidth-theme">
			<div class="row">
				<div class="col-md-12">
					<div class="menu-only">
						<nav class="mega-menu sliced">
							<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
								array(
									"COMPONENT_TEMPLATE" => ".default",
									"PATH" => SITE_DIR."include/menu/menu.".($arTheme["HEADER_TYPE"]["LIST"][$arTheme["HEADER_TYPE"]["VALUE"]]["ADDITIONAL_OPTIONS"]["MENU_HEADER_TYPE"]["VALUE"] == "Y" ? "top_catalog_wide" : "top").".php",
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "",
									"AREA_FILE_RECURSIVE" => "Y",
									"EDIT_TEMPLATE" => "include_area.php"
								),
								false, array("HIDE_ICONS" => "Y")
							);?>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="line-row visible-xs"></div>
</div>