<?php
/** 
 * @file
 * Contains \Drupal\rsvplist\Controller\ReportController.
*/
namespace Drupal\rsvplist\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class ReportController extends ControllerBase {
    protected function load() {
        $select = Database::getConnection()->select('rsvplist','r');
        $select->join('users_field_data','u','r.uid = u.uid');
        $select->join('node_field_data','n','r.nid = n.nid');
        $select->addField('u','name','user_name');
        $select->addField('n','title');
        $select->addField('r','mail');
        $entries=$select->execute()->fetchAll(\PDO::FETCH_ASSOC);
        return $entries;
    }

    public function report() {
        $content = array();
        $content['message'] = array('#markup' => $this->t('Below is the list of all Event RSPVs'));
        $headers = array(t('Name'),t('Event'),t('Email'),);
        $rows = array();
        foreach ($entries = $this->load() as $entry) {
            $rows[] = array_map('Drupal\Component\Utility\Html::escape', $entry);
        }
        $content['table'] = array('#type' => 'table', '#header' => $headers, '#rows' => $rows, '#empty' => t('No entires available'),);
        $content['#cache']['#max-age'] = 0;
        return $content;
    }
}