[![Build Status](https://travis-ci.org/os-pek/ospek-cli.svg?branch=master)](https://travis-ci.org/os-pek/ospek-cli)

 **Install:** 
```
$ composer global require ospek/ospek-cli
```
or build
```
$ git clone https://github.com/os-pek/ospek-cli.git
$ cd ospek-cli
$ composer install
$ ./vendor/bin/box build
$ mv ospek.phar /local/bin/ospek
```


 **Start php in background:** 
```
$ ospek start <php file>
```
 option:
  - --pid , -p : path file to store pid
  - --output, -o : path file to store output

**Check pid status:**
```
$ ospek status <pid>
```
 option:
  - --file, -f : path file contain pid

**Kill process:**  
```
$ ospek kill <pid>
```
 option:
  - --file, -f : path file contain pid

**Start other program:** 
```
$ ospek sh <'command'>
```
option:
  - --pid , -p : path file to store pid
  - --output, -o : path file to store output

