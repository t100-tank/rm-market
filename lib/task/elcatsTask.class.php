<?php

class elcatsTask extends sfBaseTask {
    var $cookieFile = null;

    protected function configure() {
        $this->namespace = 'scrab';
        $this->name = 'elcats';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [scrab:elcats|INFO] task does things.
Call it with:

  [php symfony scrab:elcats|INFO]
EOF;
        
    }

    protected function execute($arguments = array(), $options = array()) {
        ini_set("memory_limit", "512M");
        ini_set("max_execution_time", "1800");
        require_once(sfConfig::get('sf_root_dir') . '/config/ProjectConfiguration.class.php');
        $configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
        sfContext::createInstance($configuration);

        // Remove the following lines if you don't use the database layer
        $databaseManager = new sfDatabaseManager($configuration);
        $databaseManager->loadConfiguration();
        
        $this->cookieFile = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.'elcats.txt';
        $fh = fopen($this->cookieFile, 'w+');
        fclose($fh);
        
        /*
        $this->log('Login open');
        $login = $this->scrab('http://www.elcats.ru/Registration/CLogin.aspx');
        $this->log('Login retieved');
     
        $checkFields = array('__EVENTARGUMENT', '__EVENTTARGET', '__VIEWSTATE');
        $loginData = array();
        foreach ($checkFields as $field) {
            $loginData[$field] = '';
            if (preg_match("/name=\"__VIEWSTATE\".*?value=\"(.+?)\"[\s]*?\/>/is", $login, $out))
                $loginData[$field] = $out[1];
        }
        $loginData['ctl00$cphMasterPage$btnLogin'] = 'Войти';
        $loginData['ctl00$cphMasterPage$txbLogin'] = '9851539335';
        $loginData['ctl00$cphMasterPage$txbPassword'] = '4d58EE';
        sleep(5);
        
        $this->log('Login try');
        $login = $this->scrab('http://www.elcats.ru/Registration/CLogin.aspx', true, $loginData, array(
            CURLOPT_REFERER => 'http://www.elcats.ru/Registration/CLogin.aspx'
        ));
        $this->log('Login fin');
        file_put_contents(sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.'login.html', $login);*/
        
        $this->log('Main page get');
        $main = $this->scrab('http://www.elcats.ru/');
        $this->log('Main page got');
        
        if (preg_match("/<a class=\"menu1\" href=\"([\/a-zA-Z0-9_\-]+?)\">[\s]*<b>[\s]*OPEL[\s]*<\/b>[\s]*<\/a>/s", $main, $out)) {
            $content = $this->scrab('http://www.elcats.ru'.$out[1]);

            preg_match_all("/<a href=\"javascript\:submit\(\'(.+?)\',\'(.*?)\',\'(.+?)\'\);\">/i", $content, $models);
            $cl = CarLabelPeer::tryAdd('Opel', 'opel');
            $unique = array();
            $i = 0;
            foreach ($models[3] as $key => $value) {
                $i++;
                $item = array(
                    'p1' => $models[1][$key],
                    'p2' => $models[2][$key],
                    'model' => $value
                );
                $slug = Common::slugify('opel-'.$value);
                if (isset($unique[$slug])) {
                    $i = 2;
                    while (isset($unique[$slug.'-'.$i])) {
                        $i++;
                    }
                    $slug .= '-'.$i;
                }
                $unique[$slug] = true;
                $item['slug'] = $slug;
                $clSub = CarLabelPeer::tryAdd($value, $slug, $cl->getId());

                $link = 'http://www.elcats.ru/opel/Group.aspx?Model='.urlencode($item['p1']).'&Title='.urlencode($item['model']);
                $this->log($link);
                $content = $this->scrab($link, false, array(), array(
                    CURLOPT_REFERER => 'http://www.elcats.ru/opel/')
                );
                $this->log('Opel('.$item['slug'].')');
                file_put_contents(sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.$item['slug'].'.html', $content);
                $this->log('Memo used: '.memory_get_usage(true));
                
                preg_match_all("/<a href=\"javascript:ToggleNode\(\'([\d]+)\'\)\">([^<].+?)<\/a>/i", $content, $topCategories);
                $categories = array();
                foreach ($topCategories[1] as $key => $num) {
                    /* clean-up */
                    $catName = $topCategories[2][$key];
                    $catName = str_replace('&nbsp;', ' ', $catName);
                    $catName = preg_replace("/\[.+?\]/", '', $catName);
                    $catName = trim($catName);
                    $catName = strtolower($catName);
                    $catSlug = Common::slugify($catName);
                    
                    $category = array(
                        'name' => $catName,
                        'slug' => $catSlug,
                        'sub' => array()
                    );
                    
                    if (preg_match("/<div id=\"d".$num."\".*?>(.+?)<\/div>/is", $content, $sub)) {
                        preg_match_all("/<a href=\"javascript\:submit\(\'(.+?)\',\'(.+?)\',\'(.+?)\',\'(.+?)\'\);\">(.+?)<\/a>/is", $sub[1], $subs);
                        foreach ($subs[5] as $key => $subName) {
                            $subName = str_replace('&nbsp;', ' ', $subName);
                            $subName = preg_replace("/\[.+?\]/", '', $subName);
                            $subName = trim($subName);
                            $subName = strtolower($subName);
                            $category['sub'][] = array(
                                'p1' => $subs[1][$key],
                                'p2' => $subs[2][$key],
                                'p3' => $subs[3][$key],
                                'p4' => $subs[4][$key],
                                'name' => $subName,
                                'slug' => Common::slugify($catSlug.'-'.$subName)
                            );
                        }
                        /* clean-up */
                        unset($subs);
                    }
                    
                    $cat = CategoryPeer::tryAdd($catName, $catSlug);
                    $carCat = CarCategoryPeer::tryAdd($clSub->getId(), $cat->getId());
                    unset($carCat);
					foreach ($category['sub'] as $item) {
                        $cat1 = CategoryPeer::tryAdd($item['name'], $item['slug'], $cat->getId());
                        $carCat1 = CarCategoryPeer::tryAdd($clSub->getId(), $cat1->getId());
                        /* clean-up */
                        unset($carCat1);
						unset($cat1);
					}
                    $this->log($cat->getSlug().' (Memo used: '.memory_get_usage(true).')');
                    unset($cat);
                }
                
                //if ($i == 10) break;
            }
        }   

    }
    
    protected function scrab($url, $isPost = false, $params = array(), $curlParams = array()) {
        $ch = curl_init($url);
        $curlP = array(
            CURLOPT_AUTOREFERER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_MAXREDIRS => 20,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0 FirePHP/0.7.4', /* Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36 */
            CURLOPT_COOKIEJAR => $this->cookieFile,
            CURLOPT_COOKIEFILE => $this->cookieFile,
            CURLOPT_HTTPHEADER => array(
                "Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
                "Accept-Language" => "en-US,en;q=0.5",
                "Connection" => "keep-alive",
                "x-insight" => "activate"
            )
        );
        if ($isPost) {
            $fields_string = '';
            foreach($params as $key=>$value) $fields_string .= $key.'='.$value.'&';
            $fields_string = substr($fields_string, 0, strlen($fields_string)-1);
            $curlP[CURLOPT_POSTFIELDS] = $fields_string;
            $curlP[CURLOPT_POST] = 1;
        }
        foreach ($curlParams as $key => $value) $curlP[$key] = $value;
        foreach ($curlP as $key => $value) {
            curl_setopt($ch, $key, $value);
        }
        $content = curl_exec($ch);
        curl_close($ch);
        sleep(1);
        return $content;
    }

}
