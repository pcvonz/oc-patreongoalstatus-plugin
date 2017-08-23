## October patreon
![Screenshot](screenshot.png)

### Setup:

- Create the folder `paul` in the plugins section of your October installation
- Run `git clone https://github.com/pcvonz/october_patreon_goal_status.git patreon`
- In the newly cloned directory run `composer install && bower install`
- Make sure you change the folder permissions so your web server can read the contents of this directory (`chown -R web_server_user october/plugins/paul`)
- Open up the back end page, there should be a tab called 'patreon'
