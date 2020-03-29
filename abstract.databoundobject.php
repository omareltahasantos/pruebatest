<?php


abstract class DataBoundObject {

   protected $ID;
   protected $objPDO;
   protected $strTableName;
   protected $arRelationMap;
   protected $blForDeletion;
   protected $blIsLoaded;
   protected $arModifiedRelations;
   protected $username;
   protected $campo;
   protected $valor;
   protected $valor2;
   protected $signo;
   protected $where;
   protected $campo2;
   protected $signo2;
   protected $where2;
   protected $campo3;
   protected $signo3;
   protected $valor3;
   protected $where3;
   protected $campo4;
   protected $signo4;
   protected $valor4;
   protected $table;
   protected $camps;
   protected $campoWhere;
   protected $signoS;
   protected $valorS;
   protected $valorS2;
   protected $campoWhere2;
   protected $condicionOR;
   protected $condicionAND;
   protected $parentesisderecho;
   protected $parentesisizquierdo;


   abstract protected function DefineTableName();
   abstract protected function DefineRelationMap();

   public function __construct(PDO $objPDO, $signo = NULL, $campoBD= NULL, $valor = NULL, $where = NULL, $campo2=NULL, $signo2 = NULL, $valor2 = NULL , $where2 = NULL, $campo3=NULL, $signo3 = NULL, $valor3 = NULL, $where3 = NULL, $campo4=NULL, $signo4 = NULL, $valor4 = NULL) {
      $this->strTableName = $this->DefineTableName();
      $this->arRelationMap = $this->DefineRelationMap();
      $this->objPDO = $objPDO;
      $this->blIsLoaded = false;

      if (isset($valor)) {
         $this->valor = $valor;
         $this->campo = $campoBD;
         $this->signo = $signo;

      };


      if(isset($signo2))
      {
         $this->signo2 = $signo2;
      }   

      if(isset($campo2))
   {
      $this->campo2 = $campo2;
   }   

   if(isset($valor2))
   {
      $this->valor2 = $valor2;
   }  

   if(isset($where))
   {
      $this->where = $where;
   }  
     
   

   if(isset($signo3))
   {
      $this->signo3 = $signo3;
   }   

      if(isset($campo3))
   {
      $this->campo3 = $campo3;
   }   
   if(isset($valor3))
   {
      $this->valor3 = $valor3;
   }  
   if(isset($where2))
   {
      $this->where2 = $where2;
   }  



   if(isset($signo4))
   {
      $this->signo4 = $signo4;
   }   

      if(isset($campo4))
   {
      $this->campo4 = $campo4;
   }   
   if(isset($valor4))
   {
      $this->valor4 = $valor4;
   }  
   if(isset($where3))
   {
      $this->where3 = $where3;
   }  



      $this->arModifiedRelations = array();
   }

   public function onlySelectForEach($tabla = NULL, $campos= NULL, $signoS = NULL, $campoWhere = NULL, $valorS= NULL, $campoWhere2 = NULL, $valorS2= NULL , $condicionOR = NULL, $condicionAND= NULL, $parentesisderecho =NULL, $parentesisizquierdo= NULL){
      if(isset($tabla)){
         $this->table = $tabla;
      }  
      if(isset($campos)){
         $this->camps = $campos;
      }
      if(isset($campoWhere)){
         $this->campoWhere = $campoWhere;
      }
      if(isset($signoS)){
         $this->signoS = $signoS;
      }
     
      if(isset($valorS)){
         $this->valorS = $valorS;

      }
      if(isset($campoWhere2)){
         $this->campoWhere2 = $campoWhere2;
      }

      if(isset($valorS2)){
         $this->valorS2 = $valorS2;

      }
      if(isset($condicionOR)){
         $this->condicionOR = $condicionOR;

      }
      if(isset($condicionAND)){
         $this->condicionAND = $condicionAND;

      }
     
      if(isset($parentesisderecho)){
         $this->parentesisderecho = $parentesisderecho;

      }
      if(isset($parentesisizquierdo)){
         $this->parentesisizquierdo = $parentesisizquierdo;

      }

 
      if((isset($campos) && isset($signoS) && isset($tabla) && isset($campoWhere) && isset($valorS)) && (!isset($campoWhere2) && !isset($valorS2) && !isset($condicionOR) && !isset($condicionAND) && !isset($parentesisderecho) && !isset($parentesisizquierdo) ) ){
         $stmt = $GLOBALS['objPDO']->query("SELECT ".$this->camps. " FROM " .$this->table . " WHERE " .$this->campoWhere. " " . $this->signoS. $this->valorS);
      }else if(isset($campos) && isset($signoS) && isset($tabla) && isset($campoWhere) &&isset($valorS) && isset($campoWhere2) && isset($valorS2) && isset($condicionOR) && isset($condicionAND) && isset($parentesisizquierdo) && isset( $parentesisderecho)){
       //  echo "HE ENTRADO";
         $stmt = $GLOBALS['objPDO']->query("SELECT ".$this->camps. " FROM " .$this->table . " WHERE " .$this->parentesisizquierdo. $this->campoWhere." " . $this->signoS. " ".  $this->valorS. " ". $this->condicionAND. " ". $this->campoWhere2. " " . $this->signoS . " ". $this->valorS2. $this->parentesisderecho. " " .$this->condicionOR ." ".$this->parentesisizquierdo . $this->campoWhere. " " . $this->signoS. " ".   $this->valorS2. " ". $this->condicionAND. " ". $this->campoWhere2. " " . $this->signoS . " ". $this->valorS.$this->parentesisderecho );
      }else if( (isset($campos) && isset($signoS) && isset($tabla) && isset($campoWhere) &&isset($valorS) && isset($campoWhere2) && isset($valorS2) && isset($condicionOR) && isset($condicionAND)) && ((!isset($this->parentesisderecho)) && (!isset($this->parentesisizquierdo) ))){
         $stmt = $GLOBALS['objPDO']->query("SELECT ".$this->camps. " FROM " .$this->table . " WHERE " .$this->campoWhere. " " . $this->signoS. " ".  $this->valorS. " ". $this->condicionAND. " " .$this->campoWhere2. " " . $this->signoS. " ".  $this->valorS2. " ". $this->condicionAND. " " . "status = 1");
       
      }

      
      return $stmt;

     
   }

   public function Load() {
      if (isset($this->valor)) {
		$strQuery = "SELECT ";
        foreach ($this->arRelationMap as $key => $value) {
			$strQuery .= "\"" . $key . "\",";
        }
        $strQuery = substr($strQuery, 0, strlen($strQuery)-1);
        if(isset($this->where) && isset($this->signo2) && isset($this->campo2) && isset($this->valor2) && (!isset($this->where2) && !isset($this->signo3) && !isset($this->campo3) && !isset($this->valor3) && !isset($this->where3) && !isset($this->signo4) && !isset($this->campo4) && !isset($this->valor4)) ){
         $strQuery .= " FROM " . $this->strTableName . " WHERE \"". $this->campo ."\" " .$this->signo. ":eid ".$this->where. "\"". $this->campo2 ."\" " .$this->signo2. ":eid2 ";
         $objStatement = $this->objPDO->prepare($strQuery);
         $objStatement->bindParam(':eid', $this->valor, PDO::PARAM_STR);
         $objStatement->bindParam(':eid2', $this->valor2, PDO::PARAM_STR);
        }else if(isset($this->where) && isset($this->signo2) && isset($this->campo2) && isset($this->valor2)&& isset($this->where2) && isset($this->signo3) && isset($this->campo3) && isset($this->valor3)){
         $strQuery .= " FROM " . $this->strTableName . " WHERE \"". $this->campo ."\" " .$this->signo. ":eid ".$this->where. "\"". $this->campo2 ."\" " .$this->signo2. ":eid2 " .$this->where2. "\"". $this->campo3 ."\" " .$this->signo3. ":eid3 ";
         $objStatement = $this->objPDO->prepare($strQuery);
         $objStatement->bindParam(':eid', $this->valor, PDO::PARAM_STR);
         $objStatement->bindParam(':eid2', $this->valor2, PDO::PARAM_STR);
         $objStatement->bindParam(':eid3', $this->valor3, PDO::PARAM_STR);
        }else if(isset($this->where) && isset($this->signo2) && isset($this->campo2) && isset($this->valor2)&& isset($this->where2) && isset($this->signo3) && isset($this->campo3) && isset($this->valor3) && isset($this->where3) && isset($this->signo4) && isset($this->campo4) && isset($this->valor4) ){
         $strQuery .= " FROM " . $this->strTableName . " WHERE \"". $this->campo ."\" " .$this->signo. ":eid ".$this->where. "\"". $this->campo2 ."\" " .$this->signo2. ":eid2 " .$this->where2. "\"". $this->campo3 ."\" " .$this->signo3. ":eid3 " .$this->where3. "\"". $this->campo4 ."\" " .$this->signo4. ":eid4 ";
         $objStatement = $this->objPDO->prepare($strQuery);
         $objStatement->bindParam(':eid', $this->valor, PDO::PARAM_STR);
         $objStatement->bindParam(':eid2', $this->valor2, PDO::PARAM_STR);
         $objStatement->bindParam(':eid3', $this->valor3, PDO::PARAM_STR);
         $objStatement->bindParam(':eid4', $this->valor4, PDO::PARAM_STR);
        }else{
         $strQuery .= " FROM " . $this->strTableName . " WHERE \"". $this->campo ."\" " .$this->signo. ":eid ";
         $objStatement = $this->objPDO->prepare($strQuery);
         $objStatement->bindParam(':eid', $this->valor, PDO::PARAM_INT);
        }
        $objStatement->execute();
         $arRow = $objStatement->fetch(PDO::FETCH_ASSOC);
         
        foreach($arRow as $key => $value) {
          
            $strMember = $this->arRelationMap[$key];

            if (property_exists($this, $strMember)) {
                if (is_numeric($value)) {
                   eval('$this->'.$strMember.' = '.$value.';');
                } else {
                   eval('$this->'.$strMember.' = "'.$value.'";');
                };
            };
         };
       
         $this->blIsLoaded = true;
      }
   }

   public function Save() {
      if (isset($this->valor)) {
         $strQuery = 'UPDATE "' . $this->strTableName . '" SET ';
         foreach ($this->arRelationMap as $key => $value) {
            eval('$actualVal = &$this->' . $value . ';');
            if (array_key_exists($value, $this->arModifiedRelations)) {
               $strQuery .= '"' . $key . "\" = :$value, ";
            };
         }
         $strQuery = substr($strQuery, 0, strlen($strQuery)-2);
         if(isset($this->where) && isset($this->signo2) && isset($this->campo2) && isset($this->valor2)){
            $strQuery .= " WHERE \"". $this->campo ."\"".$this->signo. ":eid" .$this->where. "\"". $this->campo2 ."\" " .$this->signo2. ":eid2 ";
            unset($objStatement);
            $objStatement = $this->objPDO->prepare($strQuery);
            $objStatement->bindValue(':eid', $this->valor, PDO::PARAM_INT);
            $objStatement->bindValue(':eid2', $this->valor2, PDO::PARAM_INT);

         }else if(isset($this->where) && isset($this->signo2) && isset($this->campo2) && isset($this->valor2)&& isset($this->where2) && isset($this->signo3) && isset($this->campo3) && isset($this->valor3)){
            $strQuery .= " WHERE \"". $this->campo ."\"".$this->signo. ":eid" .$this->where. "\"". $this->campo2 ."\" " .$this->signo2. ":eid2 " .$this->where2. "\"". $this->campo3 ."\" " .$this->signo3. ":eid3 ";
            unset($objStatement);
            $objStatement = $this->objPDO->prepare($strQuery);
            $objStatement->bindValue(':eid', $this->valor, PDO::PARAM_INT);
            $objStatement->bindValue(':eid2', $this->valor2, PDO::PARAM_INT);
            $objStatement->bindValue(':eid3', $this->valor3, PDO::PARAM_INT);
         }else if(isset($this->where) && isset($this->signo2) && isset($this->campo2) && isset($this->valor2)&& isset($this->where2) && isset($this->signo3) && isset($this->campo3) && isset($this->valor3) && isset($this->where3) && isset($this->signo4) && isset($this->campo4) && isset($this->valor4) ){
            $strQuery .= " WHERE \"". $this->campo ."\"".$this->signo. ":eid" .$this->where. "\"". $this->campo2 ."\" " .$this->signo2. ":eid2 " .$this->where2. "\"". $this->campo3 ."\" " .$this->signo3. ":eid3 " .$this->where3. "\"". $this->campo4 ."\" " .$this->signo4. ":eid4 ";
            unset($objStatement);
            $objStatement = $this->objPDO->prepare($strQuery);
            $objStatement->bindValue(':eid', $this->valor, PDO::PARAM_INT);
            $objStatement->bindValue(':eid2', $this->valor2, PDO::PARAM_INT);
            $objStatement->bindValue(':eid3', $this->valor3, PDO::PARAM_INT);
            $objStatement->bindValue(':eid4', $this->valor4, PDO::PARAM_INT);
         }else{
            $strQuery .= " WHERE \"". $this->campo ."\" = :eid";
            unset($objStatement);
            $objStatement = $this->objPDO->prepare($strQuery);
            $objStatement->bindValue(':eid', $this->valor, PDO::PARAM_INT);
         }
          

         
        
         foreach ($this->arRelationMap as $key => $value) {
            eval('$actualVal = &$this->' . $value . ';');
            if (array_key_exists($value, $this->arModifiedRelations)) {
               if ((is_int($actualVal)) || ($actualVal == NULL)) {
                  $objStatement->bindValue(':' . $value, $actualVal,PDO::PARAM_INT);
               } else {
                  $objStatement->bindValue(':' . $value, $actualVal,PDO::PARAM_STR);
               };
            };
         };
         $objStatement->execute();
      } else {
         $strValueList = "";
         $strQuery = 'INSERT INTO "' . $this->strTableName . '"(';
         foreach ($this->arRelationMap as $key => $value) {
            eval('$actualVal = &$this->' . $value . ';');
            if (isset($actualVal)) {
               if (array_key_exists($value, $this->arModifiedRelations)) {
                  $strQuery .= '"' . $key . '", ';
                  $strValueList .= ":$value, ";
               };
            };
         }
         $strQuery = substr($strQuery, 0, strlen($strQuery) - 2);
         $strValueList = substr($strValueList, 0, strlen($strValueList) - 2);
         $strQuery .= ") VALUES (";
         $strQuery .= $strValueList;
         $strQuery .= ")";
         //$ids = $this->getID();
         unset($objStatement);
         $objStatement = $this->objPDO->prepare($strQuery);
         foreach ($this->arRelationMap as $key => $value) {
            eval('$actualVal = &$this->' . $value . ';');
            if (isset($actualVal)) {   
               if (array_key_exists($value, $this->arModifiedRelations)) {
                  if ((is_int($actualVal)) || ($actualVal == NULL)) {
                     $objStatement->bindValue(':' . $value, $actualVal, PDO::PARAM_INT);
                  } else {
                     $objStatement->bindValue(':' . $value, $actualVal, PDO::PARAM_STR);
                  };
               };
            };
         }
         $objStatement->execute();
        $this->valor = $this->objPDO->lastInsertId();
      }
   }

   public function MarkForDeletion() {
      $this->blForDeletion = true;
   }
   
   public function __destruct() {
      if (isset($this->valor)) {   
         if ($this->blForDeletion == true) {
            $strQuery = 'DELETE FROM "' . $this->strTableName . " WHERE \"". $this->campo ."\" = :eid";;
            $objStatement = $this->objPDO->prepare($strQuery);
            $objStatement->bindValue(':eid', $this->valor, PDO::PARAM_INT);   
            $objStatement->execute();
         };
      }
   }

   public function __call($strFunction, $arArguments) {

      $strMethodType = substr($strFunction, 0, 3);
      $strMethodMember = substr($strFunction, 3);
      switch ($strMethodType) {
         case "set":
            return($this->SetAccessor($strMethodMember, $arArguments[0]));
            break;
         case "get":
            return($this->GetAccessor($strMethodMember));   
      };
      return(false);   
   }

   private function SetAccessor($strMember, $strNewValue) {
      if (property_exists($this, $strMember)) {
         if (is_numeric($strNewValue)) { 
            eval('$this->' . $strMember . ' = ' . $strNewValue . ';');
         } else {
            eval('$this->' . $strMember . ' = "' . $strNewValue . '";');
         };
         $this->arModifiedRelations[$strMember] = "1";
         return($this);
      } else {
         return(false);
      };   
   }

   private function GetAccessor($strMember) {
      if ($this->blIsLoaded != true) {
         $this->Load();
      }
      if (property_exists($this, $strMember)) {
         eval('$strRetVal = $this->' . $strMember . ';');
         return($strRetVal);
      } else {
         return(false);
      };   
   }
   
}
error_reporting(0);

?>
