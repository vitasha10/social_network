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

	$this->loadLanguage('global.php');
	$this->loadLanguage('dashboard.php');

    $D->_IN_DASHBOARD = TRUE;
    $D->_WITH_NOTIFIER = TRUE;

	$D->isPhantom = FALSE;
	if ($this->param('phantom') && $this->param('phantom')=='yes') $D->isPhantom = TRUE;

	$D->layout_size = 'min';
	if ($this->param('lysize')) $D->layout_size = $this->param('lysize');
    
    /************************************************/
    $the_sanitaze = new sanitize(); // init sanitaze

    $cad_cat = '';
    $cad_subcat = '';

	$D->m_category = -1;
	$D->m_subcategory = -1;
	if ($this->param('c')) $D->m_category = $this->param('c');
	if ($this->param('s')) $D->m_subcategory = $this->param('s');
    if ($D->m_category != 'all') {
        $D->m_category = $the_sanitaze->int($D->m_category);
        if ($D->m_category > 0) $cad_cat = ' AND idcategory='.$D->m_category.' ';
        else $D->m_category = -1;
    } else $D->m_category = -1;
    
    if ($D->m_subcategory != 'all') {
        $D->m_subcategory = $the_sanitaze->int($D->m_subcategory);
        if ($D->m_subcategory > 0) $cad_subcat = ' AND idsubcategory='.$D->m_subcategory.' ';
        else $D->m_subcategory = -1;
    } else $D->m_subcategory = -1;
    
    $D->open_filter = FALSE;
    if (!empty($cad_cat) || !empty($cad_subcat)) $D->open_filter = TRUE;
    
    /************************************************/
    
    $D->show_more = FALSE;
    $D->the_list_items = '';
    
    $K->ITEMS_PER_PAGE = $K->ITEMS_PER_PAGE_MARKETPLACE;
    
    $total_items = 0;
    
    $products = $this->db2->fetch_all("SELECT * FROM products WHERE 1=1 ".$cad_cat.$cad_subcat." ORDER BY idproduct DESC LIMIT 0, ".($K->ITEMS_PER_PAGE + 1));
    if ($products) {
        $total_items = count($products);
        $count_regs = 0;
        foreach($products as $oneproduct) {
            
            $D->product = $oneproduct;
            $D->product->name = stripslashes($D->product->name);
            $idcurrency = $D->product->currency;
            
            $D->currency = $network->getCurrencySymbol($idcurrency);
    
            $D->product->price = number_format($D->product->price, 2);

            $D->photo = array();
            $photos_prod = $this->db2->fetch_all("SELECT * FROM products_images WHERE idproduct=".$D->product->idproduct);
            if ($photos_prod) {
                foreach ($photos_prod as $onephoto) {
                    $D->photo[] = $onephoto->photo;
                }
            }
            $D->photo_product = $K->STORAGE_URL_PRODUCTS .'min2/'. $D->photo[0];
            
            $D->product->location = stripslashes($D->product->location);
            
            $theusername_of_sell = $this->db2->fetch_field("SELECT user_username FROM users WHERE iduser=".$D->product->idsell." LIMIT 1");
            $code_post_prod = $this->db2->fetch_field("SELECT code FROM posts WHERE idpost=".$D->product->idpost." LIMIT 1");
            
            $D->product->url = $K->SITE_URL.$theusername_of_sell.'/post/'.$code_post_prod;
            

            $D->the_list_items .= $this->load_template('ones/one-product-market.php', FALSE);

            $count_regs++;
            if ($count_regs >= $K->ITEMS_PER_PAGE) break;
        
        }

        if ($total_items > $K->ITEMS_PER_PAGE) $D->show_more = TRUE;
        
    }
    
    /************************************************/
    
    /************************************************/

    $D->id_menu = 'opt_ml_marketplace';

	if ($D->isPhantom) {

        $html = '';
        $this->load_extract_controller('_dashboard-menu-left');

		if ($D->layout_size == 'min') {
            $for_load = 'min/marketplace.php';
		} else {
            $for_load = 'max/marketplace.php';
		}

        $D->titlePhantom = $this->lang('dashboard_marketplace_title_page');

        $html .= $this->load_template($for_load, FALSE);
        echo $html;

	} else {

        $this->load_extract_controller('_required-dashboard');
        $this->load_extract_controller('_dashboard-bar-top');
        $this->load_extract_controller('_dashboard-menu-left');

        $D->page_title = $this->lang('dashboard_marketplace_title_page');

        $D->file_in_template = 'max/marketplace.php';
        $this->load_template('dashboard-template.php');

    }

?>