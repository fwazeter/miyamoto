# Configuration & Testing

Naturally, start with `composer install` to get the dependencies.

For initializing of the `bash` script, first run `chmod +x path/to/bin/miya` in either a linux or server environment, or in Git Bash on windows. Alternatively, you can do `php bin/miya`. 

Once that has been run once, you can test with cli commands like `./bin/miya site:create`

## Windows

Add to 'path' in environment variables to run `miya` from anywhere. e.g. `C:\Users\username\path\to\project\bin` omit the `miya` at end. 

## Linux

First, initialize it with `chmod +x path/to/bin/miya`, then create the symlink with `ln -s` to `/usr/local/bin` or `/usr/bin` or any other location in your `$PATH` environment variable.

`sudo ln -s /path/to/your/project/bin/miya /usr/local/bin/miya
`

Link verification: `ls -l /usr/local/bin/miya`