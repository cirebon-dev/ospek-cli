 **Install:** 
```
$ composer global require ospek/ospek-cli
```
or download single executable [ospek.phar](https://github.com/os-pek/ospek-cli/raw/phar/ospek.phar)

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
$ ospek sh <"command">
```
option:
  - --pid , -p : path file to store pid
  - --output, -o : path file to store output

