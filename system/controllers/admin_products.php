<?php
/*
********************************************************
* @author Santos Montano B. (Lito Santos M.)
* @author_url 1: http://www.kanorika.com
* @author_url 2: http://codecanyon.net/user/kanorika
* @author_email: info@kanorika.com   
********************************************************
* iSocial - Social Networking Platform
* Copyright (c) 2018 iSocial. All rights reserved.
********************************************************
*/
	if (!$D->_IS_LOGGED) $this->globalRedirect('login');
	if (!$D->_IS_ADMIN_USER) $this->globalRedirect('login');

    $D->_IN_ADMIN_PANEL = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');
	$this->loadLanguage('admin.php');

    /****************************************************************/    
    /****************************************************************/

    $D->me = $this->user->info;

    $D->qsql = '';
	$D->PRODUCTS_PER_PAGE = $K->ITEMS_PER_PAGE;
	$D->pageCurrent = 1;
	if ($this->param('p')) $D->pageCurrent = $this->param('p');
	$D->totalitems = $this->db2->fetch_field('SELECT count(idproduct) FROM products '.$D->qsql);
	$D->start = ($D->pageCurrent-1) * $D->PRODUCTS_PER_PAGE;

    /**** Pagination ****/

    $D->url_list = $K->SITE_URL.'admin/products/';

    $D->totalPag = ceil($D->totalitems/$D->PRODUCTS_PER_PAGE);
    if ($D->totalPag == 0) $D->totalPag = 1;
    if ($D->totalPag < $D->pageCurrent) $this->globalRedirect($D->url_list);
    $D->pagVisibles = 2;

    if ($D->totalPag > (2 * $D->pagVisibles) + 1) {

        $D->firstPage = $D->pageCurrent - $D->pagVisibles;
        if ($D->firstPage < 1) $D->firstPage = 1;

        $D->lastPage = $D->firstPage + (2 * $D->pagVisibles);
        if ($D->lastPage > $D->totalPag) $D->lastPage = $D->totalPag;

        if ($D->lastPage - $D->firstPage < (2 * $D->pagVisibles) + 1) $D->firstPage = $D->lastPage - (2 * $D->pagVisibles);

    } else {

        $D->firstPage = 1;
        $D->lastPage = $D->totalPag;

    }

    /********************/

    $items = $this->db2->fetch_all("SELECT idproduct, products.code, idpost, name, users.user_username, users.firstname, users.lastname FROM products, users WHERE iduser=idsell ".$D->qsql." ORDER BY idproduct DESC LIMIT ".$D->start.",".$D->PRODUCTS_PER_PAGE);

    $D->numitems = count($items);

    $D->html_items = '';

    foreach ($items as $oneitem) {

        $D->one = $oneitem;

        $D->one->avatar = empty($oneitem->avatar) ? $K->DEFAULT_AVATAR_PAGE : $oneitem->avatar;
        $D->one->avatar = $K->STORAGE_URL_AVATARS_PAGE.'min2/'.($D->one->avatar == $K->DEFAULT_AVATAR_PAGE ? '' : $D->one->code.'/') . $D->one->avatar;

        $D->one->allname = stripslashes($oneitem->name);
        $D->one->creator_name = stripslashes($oneitem->firstname).' '.stripslashes($oneitem->lastname);
        $D->one->creator_username = stripslashes($oneitem->user_username);
        
        $D->photo = array();
        $photos_prod = $this->db2->fetch_all("SELECT * FROM products_images WHERE idproduct=".$D->one->idproduct);
        if ($photos_prod) {
            foreach ($photos_prod as $onephoto) {
                $D->photo[] = $onephoto->photo;
            }
        }
        $D->one->photo = $K->STORAGE_URL_PRODUCTS.'min1/'.$D->photo[0];
        
        $codepost = $this->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$D->one->idpost." LIMIT 1");
        $D->one->url = $K->SITE_URL.$D->one->creator_username.'/post/'.$codepost;
        $D->html_items .= $this->load_template('ones/one-product-list.php', FALSE);

    }

    /****************************************************************/    
    /****************************************************************/

    $D->js_script_min = $this->designer->getStringJS('admin');

    $D->id_menu = 'opt_adm_products';

	if ($D->isPhantom) {

        $html = '';

        $this->load_extract_controller('_admin-menu-left');

		if ($D->layout_size == 'min') {

            $for_load = 'min/admin-products.php';

		} else {

            $for_load = 'max/admin-products.php';

		}

        $D->titlePhantom = $this->lang('admin_products_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_admin-menu-left');

		$D->page_title = $this->lang('admin_products_title_page');    	

        $D->file_in_template = 'max/admin-products.php';
        $this->load_template('dashboard-template.php');

	}

?>