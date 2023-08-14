
# Intimate Tales User Plugin

A WordPress plugin to manage user-related functionalities for the IntimateTales platform.

## Description

The `Intimate Tales User` plugin provides functionalities to manage users, their profiles, and actions within the IntimateTales platform.

## Installation

1. Download the plugin ZIP file.
2. Upload the ZIP file to your WordPress site.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

Once activated, the plugin integrates seamlessly with the IntimateTales platform and provides user management features.

## Support

For support, please contact [Dawid Rogaczewski](https://www.intimate-tales.de).

## License

GPLv3 or later

## Models - Invites

- **Invite_Generator.php**: Contains the logic to generate an invite based on a recipient ID.
- **Invite_Repository.php**: Interface that lays out the structure for managing invites.
- **Invite.php**: Main class representing an invite. Contains methods for generating URLs and database structure.
- **Sql_Invite_Repository.php**: Implementation of the Invite_Repository interface for SQL databases.
