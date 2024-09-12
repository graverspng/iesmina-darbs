<?php
class Database {
  private $pdo;

  public function __construct($config) {
    $connection_string = "mysql:" . http_build_query($config, "", ";");
    $this->pdo = new PDO($connection_string);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }

  public function execute($query_string, $params) {
    $query = $this->pdo->prepare($query_string);
    $query->execute($params); 
    return $query;
  }

  public function reserve($apartment_id, $user_id) {

    $query = "SELECT * FROM reservations WHERE user_id = ?";
    $params = [$user_id];
    $existingReservation = $this->execute($query, $params)->fetch();

    if ($existingReservation) {
      throw new Exception("You already have an active reservation.");
    }

    // Check if the apartment exists
    $query = "SELECT * FROM apartments WHERE apartment_id = ?";
    $params = [$apartment_id];
    $apartment = $this->execute($query, $params)->fetch();

    if (!$apartment) {
      throw new Exception("Apartment not found.");
    }

    // Insert the reservation
    $query = "INSERT INTO reservations (apartment_id, name, price, stars, date, amount, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = [$apartment_id, $apartment['name'], $apartment['price'], $apartment['stars'], $apartment['date'], $apartment['amount'], $user_id];
    $this->execute($query, $params);

    // Update the apartment amount
    $query = "UPDATE apartments SET amount = amount - 1 WHERE apartment_id = ?";
    $params = [$apartment_id];
    return $this->execute($query, $params);
  }

  public function unreserve($reserve_id) {
    $query = "SELECT * FROM reservations WHERE reserve_id = ?";
    $params = [$reserve_id];
    $reservation = $this->execute($query, $params)->fetch();

    if (!$reservation) {
      throw new Exception("Reservation not found.");
    }

    // Update the apartment amount
    $query = "UPDATE apartments SET amount = amount + 1 WHERE apartment_id = ?";
    $params = [$reservation['apartment_id']];
    $this->execute($query, $params);

    // Delete the reservation
    $query = "DELETE FROM reservations WHERE reserve_id = ?";
    $params = [$reserve_id];
    return $this->execute($query, $params);
  }
}
?>
