terraform {
  required_providers {
    aws ={
        source = "hashicorp/aws"
        version = "3.5.0"
    }
  }
}

provider "aws" {
  region = "us-east-1"
}
resource "aws_instance" "DPO-test" {
    ami = "ami-011899242bb"
    instance_type = "t2.micro"
    subnet_id = "${aws_subnet.public-subnet-1.id}"
    tags = {
        Name = "DPO-test"
    }
    count = 1


  
}

resource "aws_budgets_budget" "like-and-subscribe" {
    name = "Monthly budget"
    budget_type = "COST"
    time_unit = "MONTHLY"
    limit_amount = "0.5"
    limit_unit = "USD"
    time_period_start = "2024-06-07"
    time_period_end = "2024-06-30"
    
}