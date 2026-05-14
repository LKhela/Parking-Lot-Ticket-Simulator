import sys
import json
from datetime import datetime


class Car:

    def __init__(self, model, plate):

        self.model = model
        self.plate = plate

    def __repr__(self):

        return f"Car({self.model}, {self.plate})"


class ParkingTicket:

    RATE_PER_HOUR = 2.5

    def __init__(self,
                 customer_name,
                 car,
                 hours):

        self.customer_name = customer_name
        self.car = car
        self.hours = hours

        self.entry_time = datetime.now().strftime(
            "%Y-%m-%d %H:%M:%S"
        )

        self.ticket_id = (
            f"TKT-{self.car.plate}-"
            f"{datetime.now().strftime('%H%M%S')}"
        )

    def calculate_fee(self):

        return self.hours * self.RATE_PER_HOUR

    def to_dict(self):

        return {

            "ticket_id": self.ticket_id,

            "customer_name": self.customer_name,

            "car_model": self.car.model,

            "plate": self.car.plate,

            "hours": self.hours,

            "entry_time": self.entry_time,

            "fee": self.calculate_fee(),

            "slot_number": 1
        }



#todo parkinglot class to manage finding an empty slot to assign to the ticket and free it once the time runs out
 

def main():

    name = sys.argv[1]

    car_model = sys.argv[2]

    plate = sys.argv[3]

    hours = int(sys.argv[4])

    car = Car(car_model, plate)

    ticket = ParkingTicket(
        name,
        car,
        hours
    )

    print(
        json.dumps(
            ticket.to_dict()
        )
    )


if __name__ == "__main__":
    main()