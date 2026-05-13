import json
from datetime import datetime

class Car:
    def __init__(self, model: str, plate: str):
        self.model = model
        self.plate = plate

    def __repr__(self):
        return f"Car({self.model}, {self.plate})"


class ParkingTicket:
    RATE_PER_HOUR = 2.5  

    def __init__(self, customer_name: str, car: Car, hours: int):
        self.customer_name = customer_name
        self.car = car
        self.hours = hours
        self.entry_time = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        self.ticket_id = f"TKT-{self.car.plate}-{datetime.now().strftime('%H%M%S')}"

    def calculate_fee(self) -> float:
        return self.hours * self.RATE_PER_HOUR

    def to_dict(self) -> dict:
        return {
            "ticket_id": self.ticket_id,
            "customer_name": self.customer_name,
            "car_model": self.car.model,
            "plate": self.car.plate,
            "hours": self.hours,
            "entry_time": self.entry_time,
            "fee": self.calculate_fee()
        }


class ParkingSlot:
    #todo slots for the parking lot


class ParkingLot:
    #todo parking lot logic itself