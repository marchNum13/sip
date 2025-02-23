<?php
// CLASS TABLE USER
class userTableClass extends connMySQLClass{
    
    // SET ATTRIBUTE TABLE NAME
    private $table_name = "user";
    
    // CREATE DEFAULT TABLE
    public function __construct(){
        // IF TABLE DOESN'T EXISTS, CREATE TABLE!`
        if($this->checkTable($this->table_name) == 0){
            // SET QUERY
            $sql = "CREATE TABLE $this->table_name (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                id_user VARCHAR(11) NOT NULL UNIQUE,
                username VARCHAR(255) NOT NULL UNIQUE,
                email VARCHAR(255) NOT NULL UNIQUE,
                password TEXT NOT NULL,
                package ENUM('Hamdalah', 'Basmalah') NOT NULL,
                team ENUM('A', 'B', 'C') NOT NULL,
                regist_by VARCHAR(11) NOT NULL,
                upline VARCHAR(11) NOT NULL,
                user_code_verif VARCHAR(11) NOT NULL DEFAULT 'none',
                regist_date TEXT NOT NULL,
                status ENUM('Tidak Aktif', 'Aktif') NOT NULL DEFAULT 'Aktif'

            )";
            // EXECUTE THE QUERY TO CREATE TABLE
            $this->dbConn()->query($sql);
            // CLOSE THE CONNECTION
            $this->dbConn()->close();
        }
    }

    // insert data user
    public function insertUser(string $fields, string $value){
        // query
        $sql = "INSERT INTO $this->table_name ($fields) VALUE($value)";
        // EXECUTE THE QUERY TO CREATE TABLE
        $exe = $this->dbConn()->query($sql);
        // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $exe;
    }

    public function selectUserJoin(string $fields, string $join, string $key){
        // query
        $sql = "SELECT $fields FROM $this->table_name $join WHERE $key";
        // EXECUTE QUERY
        $exe = $this->dbConn()->query($sql);
        // SET DATA FROM TABLE
        while($rows = $exe->fetch_assoc()){
            $data[] = $rows;
        }
        // GET DATA TABLE
        $result["data"] = $data;
        // GET NUMS ROW TABLE
        $result["row"] = $exe->num_rows;
         // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $result;
    }

    // get data user
    public function selectUser(string $fields, string $key){
        // query
        $sql = "SELECT $fields FROM $this->table_name WHERE $key";
        // EXECUTE QUERY
        $exe = $this->dbConn()->query($sql);
        // SET DATA FROM TABLE
        while($rows = $exe->fetch_assoc()){
            $data[] = $rows;
        }
        // GET DATA TABLE
        $result["data"] = $data;
        // GET NUMS ROW TABLE
        $result["row"] = $exe->num_rows;
         // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $result;
    }
    
    // update data user
    public function updateUser(string $dataSet, string $key){
        // query
        $sql = "UPDATE $this->table_name SET $dataSet WHERE $key";
        // EXECUTE THE QUERY TO CREATE TABLE
        $exe = $this->dbConn()->query($sql);
        // CLOSE THE CONNECTION
        $this->dbConn()->close();
        return $exe;
    }

    // login check 
    public function loginMember(?string $key, ?string $param){
        $conn = $this->dbConn();
        /* create a prepared statement */
        $stmt = mysqli_prepare($conn, "SELECT COUNT(id_user), id_user, password, status FROM $this->table_name WHERE $param = ? LIMIT 1");
        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, "s", $key);
        /* execute query */
        mysqli_stmt_execute($stmt);
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $num, $id_user, $password, $status);
        /* fetch value */
        mysqli_stmt_fetch($stmt);
        // close connection
        $conn->close();
        return [
            "num" => $num,
            "id_user" => $id_user,
            "password" => $password,
            "status" => $status
        ];
    }

    // // select downlines berdasarkan user_refferal = user_upline
    // public function selectDownlines($upline) {
    //     $sql = "SELECT user_refferal, user_username, user_email FROM $this->table_name WHERE user_upline = '$upline'";
    //      // EXECUTE QUERY
    //      $exe = $this->dbConn()->query($sql);
    //      // SET DATA FROM TABLE
    //      while($rows = $exe->fetch_assoc()){
    //          $data[] = $rows;
    //      }
    //      // GET DATA TABLE
    //      $result["data"] = $data;
    //      // GET NUMS ROW TABLE
    //      $result["row"] = $exe->num_rows;
    //       // CLOSE THE CONNECTION
    //      $this->dbConn()->close();
    //      return $result;
    // }
}

    


?>