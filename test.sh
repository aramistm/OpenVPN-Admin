#!/bin/bash
random-string()
{
    cat /dev/urandom | tr -dc "a-zA-Z0-9!@#$%^&*()_+?><~\`;'" | fold -w ${1:-32} | head -n 1
}

mysql_root_pass=random-string

echo mysql_root_pass