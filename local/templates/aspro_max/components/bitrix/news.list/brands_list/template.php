<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="row sid items flexbox brands-block-row">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="box-shadow bordered colored_theme_hover_bg-block item-wrap brands-block-news">
        <div class="item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="image  w-picture">
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                 data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="Логотип <?=$arItem["NAME"]?>"
                                 title="<?=$arItem["NAME"]?>" class="img-responsive lazyloaded">
                        </a>
                    </div>
                    <div class="title font_upper muted">
                        <a  href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem["NAME"]?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

