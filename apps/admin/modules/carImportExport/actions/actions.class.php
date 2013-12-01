<?php

/**
 * carImportExport actions.
 *
 * @package    rm-market
 * @subpackage carImportExport
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class carImportExportActions extends sfActions
{

    public function preExecute() {
        parent::preExecute();
        if (!$this->getUser()->getGuardUser()->hasPermission('zapchasti')) {
            $this->redirect('@homepage');
        }
    }

    public function executeIndex(sfWebRequest $request) {}

    public function executeImportOriginalPartsForm(sfWebRequest $request) {}

    public function executeImportOriginalPartsStore(sfWebRequest $request) {
        ini_set('memory_limit', '256M');
        if ($request->isMethod(sfWebRequest::POST)) {
            $csv = $request->getFiles('csv');
            if ($csv['error'] != 0) {
                $this->getUser()->setFlash('error', 'Ошибка загрузки файла');
            } else {
                $result = CarCategoryPeer::import($csv['tmp_name'], $request->getParameter('encoding'));
                if ($result['success']) {
                    $this->getUser()->setFlash('notice', 'Файл обработан без ошибок. Было сохранено '.$result['worked']." строк(а).");
                } else {
                    $this->getUser()->setFlash('error', 'В ходе импорта произошли ошибки. Было сохранено '.$result['worked']." строк. Проблемными были строки(а): ".implode(', ', $result['errorLines']));
                }
            }
        }
        $this->redirect($request->getReferer());
    }
}
