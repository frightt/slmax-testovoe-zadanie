<?php
require_once 'connect.php';

class Person {
    private $id;
    private $name;
    private $surname;
    private $birthdate;
    private $gender;
    private $birthplace;

    public function __construct($id = null, $conn)
    {
        $this->conn = $conn;
        if ($id) {
            $sql = "SELECT * FROM people WHERE id = $id";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $person = $result->fetch_assoc();
                $this->id = $person['id'];
                $this->name = $person['name'];
                $this->surname = $person['surname'];
                $this->birthdate = $person['birthdate'];
                $this->gender = $person['gender'];
                $this->birthplace = $person['birthplace'];
            }
        }
    }

    public function save()
    {
        $sql = "INSERT INTO people (name, surname, birthdate, gender, birthplace)
        VALUES ('$this->name', '$this->surname', '$this->birthdate', '$this->gender', '$this->birthplace')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM people WHERE id=$this->id";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public static function convertAge($birthdate)
    {
        $today = new DateTime();
        $diff = $today->diff(new DateTime($birthdate));
        return $diff->y;
    }

    public static function convertGender($gender)
    {
        return $gender == 1 ? 'Male' : 'Female';
    }

    public function formatPerson($age = false, $gender = false)
    {
        $person = new stdClass();
        $person->id = $this->id;
        $person->name = $this->name;
        $person->surname = $this->surname;
        $person->birthplace = $this->birthplace;
        if ($age) {
            $person->age = self::convertAge($this->birthdate);
        }
        if ($gender) {
            $person->gender = self::convertGender($this->gender);
        }
        return $person;
    }




}