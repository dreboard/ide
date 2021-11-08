# PHP IDE

My online php IDE.  Framework less product using the front controller design pattern.
- Start write and run your php and command line code online
- Perform database queries from an integrated Sqlite file
- Create and write to xml, html, log, txt and csv files.
- Make API GET/POST requests

## WARNING

This code make use of the PHP eval() function. Run ONLY a local instance of this script

## Installation

Assuming you have a local instance of php and access to the command line:
- Clone this repo and run.

```bash
git clone https://github.com/dreboard/ide.git
php composer.phar install
php -S 0.0.0.0:8000 -t ./public
```


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)