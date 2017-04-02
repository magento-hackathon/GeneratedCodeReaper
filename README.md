## GeneratedCodeReaper

A tool to selectively delete generated code files if the originating source file has been modified.

Currently implemented reapers:  
- Interceptors  
- Proxy  

### Usage
In the Magento back-end under `Stores > Configuration > Developer > Static Files Settings >Base Paths for Generated Code Reaper` configure
the base paths you want to 

Examples: 
vendor/VENDORNAME
app/code/VENDORNAME

On demand from the command line

`setup:di:reap`

or on every request - enabled via the setting
`Stores > Configuration > Developer > Static Files Settings > Reap on all requests`

### Todo

1.) The at runtime reaper which runs on every request needs to shift to a different execution point, possibly use a 
custom ObjectManager
2.) Currently the Interceptor reaper works on the originating class only and does not pick constructor 
changes in the hierarchy