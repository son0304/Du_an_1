<?php

require_once __DIR__ . '/../Config/config.php';

class ContactModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getContact()
    {
        $sql  = "SELECT * FROM contact_items";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addContact($id_user, $id_contact, $fullname, $email, $phone, $title, $description, $status)
    {
        $sql = 'INSERT INTO contact_items (id_contact, fullname, email, phone, title, description, status) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('issssss', $id_contact, $fullname, $email, $phone, $title, $description, $status);
        $stmt->execute();
    }

    public function getContactByIdUser($id_user)
    {
        $sql = 'SELECT * FROM contacts WHERE id_user = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateContactStatus($id, $status)
    {
        $sql = "UPDATE contact_items SET status = ? WHERE id_contact = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    public function getContactById($id)
    {
        $sql = 'SELECT * FROM contact_items WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function deleteContact($id)
    {
        $sql = "DELETE FROM contact_items WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
