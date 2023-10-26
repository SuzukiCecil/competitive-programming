from collections import deque

s = input()

start = end = 0

for i in range(len(s)):
    if s[i] == "a":
        start += 1
    else:
        break
for i in range(len(s)):
    if s[len(s) - i - 1] == "a":
        end += 1
    else:
        break

if start > end:
    print("No")
    exit()

s = s.strip("a")
s_reversed = ''.join(list(reversed(s)))
if s == s_reversed:
    print("Yes")
else:
    print("No")
    