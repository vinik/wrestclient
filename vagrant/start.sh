#!/bin/bash

mysql -u root -pchangeme -h 127.0.0.1 -e "create database if not exists wrestclient;"
mysql -u root -pchangeme -h 127.0.0.1 wrestclient < initial_data.sql
