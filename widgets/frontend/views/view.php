<?php
/** @var $model \tina\metatag\models\Metatag */
/** @var $pageTitle string */
/** @var $indexTitle string */
/** @var  $indexDescription string */
/** @var  $indexKeywords string */

$metaTitle = $model->title;
$metaKeywords = $model->keywords;
$metaDescription = $model->description;

if ($model->commonTitle == 1) {
    $metaTitle .= ' : ' . $indexTitle;
}
if ($model->commonDescription == 1) {
    $metaDescription .= ' : ' . $indexDescription;
}
if ($model->commonKeywords == 1) {
    $metaKeywords .= ' : ' . $indexKeywords;
}

$this->registerMetaTag(['name' => 'title', 'content' => $pageTitle . ' : ' . $metaTitle]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $pageTitle . ' : ' . $metaKeywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $pageTitle . ' :: ' . $metaDescription]);
