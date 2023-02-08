<?php

if (!class_exists("Person")) {
    echo "Error: Class 'Person' does not exist.";
} else {
class PersonListList {
    private $idList;


    public function __construct($searchParams) {
        $db = new Database();
        $conn = $db->connect();

        $searchConditions = "";
        foreach($searchParams as $field => $value) {
            $searchConditions .= $field . " " . $value['condition'] . " '" . $value['value'] . "' AND ";
        }

        $searchConditions = substr($searchConditions, 0, -4);


        $query = "SELECT id FROM people WHERE " . $searchConditions;
        $result = $conn->query($query);

        $this->idList = [];
        while($row = $result->fetch_assoc()) {
            $this->idList[] = $row['id'];
        }


        mysqli_close($conn);
    }

    public function getPersonInstances() {
        $personInstances = [];
        foreach ($this->idList as $id) {
            $personInstances[] = new Person($id);
        }
        return $personInstances;
    }

    public function deletePerson() {

        $personInstances = $this->getPersonInstances();


        $db = new Database();
        $conn = $db->connect();


        foreach ($personInstances as $personInstance) {

            $query = "DELETE FROM people WHERE id = '" . $personInstance->getId() . "'";

            mysqli_query($conn, $query);
        }


        mysqli_close($conn);
    }
}
}
