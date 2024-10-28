<?php
require_once('./DbManager.php');
require_once('./dto/EntrieDto.php');
class EntriesDao extends DbManager {
    public function __construct() {
        parent::__construct();
    }

    public function setEntries(EntrieDto $entrieDto) {
        $insert = $this->pdo->prepare('INSERT INTO ENTIRES (title, thumb, content) VALUES (:title, :thumb, :content)');
        $entrieArray = array(
            'title' => $entrieDto->getTitle(),
            'thumb' => $entrieDto->getThumb(),
            'content' => $entrieDto->getContent()
        );
        if ($insert->execute($entrieArray)) {
            $this->pdo->commit();
            $this->resMessage = array(
                'CODE' => 0,
                'MESSAGE' => 'Succes: La Entrada se creo exitosamente',
                "CONTENT" => null
            );
        } else {
            $this->pdo->rollBack();
            $this->resMessage = array(
                'CODE' => 1,
                'MESSAGE' => 'Error: La Entrada no se creo exitosamente',
                "CONTENT" => null
            );
        }
        return $this->resMessage;
    }

    public function deleteEntries(EntrieDto $entrieDto) {
        $id = $entrieDto->getId();
        $delete = $this->pdo->prepare("DELETE FROM entries WHERE id = $id");
        if ($delete->execute()) {
            $this->pdo->commit();
            $this->resMessage = array(
                'CODE' => 0,
                'MESSAGE' => 'Succes: La Entrada se elimino exitosamente',
                "CONTENT" => null
            );
        } else {
            $this->pdo->rollBack();
            $this->resMessage = array(
                'CODE' => 1,
                'MESSAGE' => 'Error: La Entrada no se elimino exitosamente',
                "CONTENT" => null
            );
        }
        return $this->resMessage;
    }

    public function getEntries(string $type, array $dates, int $id) {
        $select = null;
        switch ($type) {
            case 'LIST':
                #SELECT * FROM entries WHERE pub_date BETWEEN '2024-04-06 00:00:00' AND '2024-04-07 00:59:59'
                $select = $this->pdo->prepare("SELECT en_id, title, thumb FROM entries WHERE pub_date BETWEEN '$dates[0]' AND '$dates[1]'");
                $select->setFetchMode(PDO::FETCH_OBJ);
                $select->execute();
                break;
            case 'IND':
                $select = $this->pdo->prepare("SELECT * FROM entries WHERE end_id = $id");
                $select->setFetchMode(PDO::FETCH_OBJ);
                $select->execute();
                break;
            default:
                throw new Exception('Error de consulta', 1);
                break;
        }
    }
}