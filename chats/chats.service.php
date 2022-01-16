<?php
  
  class ChatsService
  {
    private $conn;
    
    function __construct($conn)
    {
      $this->conn = $conn;
    }

    function getChats(): array
    {
      $sql = "SELECT * FROM Chats";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
        return [];
      }
    }

    function createChat($id, $name, $isPrivate, $inviteLink)
    {
      $sql = "INSERT INTO Chats (id, name, isPrivate, inviteLink) VALUES (:id, :name, :isPrivate, :inviteLink)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(":id", $id);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":isPrivate", $isPrivate);
      $stmt->bindValue(":inviteLink", $inviteLink);
      $stmt->execute();
    }
    
    function findById($id)
    {
      $sql = "SELECT * FROM Chats WHERE id=:id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue(":id", $id);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
      } else {
        return null;
      }
    }
  }
