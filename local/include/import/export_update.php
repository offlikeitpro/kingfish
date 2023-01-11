<?

namespace MyProjectNameSpace;

use CIBlockCMLImport;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

class MySuperImport extends CIBlockCMLImport
{

    public function DeactivateElement($action, $start_time, $interval)
    {
//        if (!$this->next_step["LAST_ID"]) {
//            $hlbl = 4;
//            $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();// get entity
//            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
//            $entity_data_class = $entity->getDataClass();
//            $res_hl = $entity_data_class::getList(array('filter' => array('ID' => 1)));
//            if ($item = $res_hl->fetch()) {
//                $this->next_step["LAST_ID"] = $item['UF_LAST_ID'];
//            }
//        }
//        $saved = $this->next_step["bUpdateOnly"];
//        $this->next_step["bUpdateOnly"] = false;
//        $return = parent::DeactivateElement($action, $start_time, $interval);
//
//        $this->next_step["bUpdateOnly"] = $saved;
        $counter = array(
            "DEL" => 0,
            "DEA" => 0,
            "NON" => 0,
        );
        return $counter;
    }
}

?>