<?php

$adminConstants = [
    'productImgPath' => 'public/Uploads/catalog/products/',
    'adminView' => 'Admin.pages',
    'adminCategoryView' => 'Admin.pages.catalog.category',
    'adminSystemUsersView' => 'Admin.pages.acl.system_users',
    'adminRoleView' => 'Admin.pages.acl.roles',
    'adminAttrSetView' => 'Admin.pages.catalog.attributes.attrSets',
    'adminAttrView' => 'Admin.pages.catalog.attributes.attrs',
    'adminProductView' => 'Admin.pages.catalog.products',
    'adminMiscellaneousView' => 'Admin.pages.Miscellaneous',
    'paginateNo' => 20
];


$frontendConstants = [
    'frontView' => 'Frontend.pages'
];


return array_merge($frontendConstants, $adminConstants);
?>