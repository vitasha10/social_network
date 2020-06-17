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
$f = '';
if ($this->param('f') && !empty($this->param('f'))) $f = $this->param('f');

$o = '';
if ($this->param('o') && !empty($this->param('o'))) $o = $this->param('o');

if (empty($f) || empty($o)) die();

header("Content-Disposition:attachment; filename=$o");
readfile($K->STORAGE_URL_ATTACH_MESSAGES.$f);