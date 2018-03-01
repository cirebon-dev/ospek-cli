 **Install:** 
```
$ composer global require ospek/ospek-cli
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
$ ospek sh <"command">
```
option:
  - --pid , -p : path file to store pid
  - --output, -o : path file to store output

