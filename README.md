Online C code compiler 

Coded in PHP. Works by calling GCC from php through shell commands. This is a very basic PoC prototype and has lot of security flaws. 

Client enters C code, and submits it to server. The server stores the code as a C file and calls GCC to compile it. Any errors during compilation are displayed to the client. Otherwise server runs the generated executable and shows the result. Uses md5 hashes of entered codes to uniquely identify them.
