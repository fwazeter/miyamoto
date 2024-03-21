<?php

namespace Miyamoto\Services;

class DirectoryService
{
    /**
     * Create a directory at the specified path and set permissions.
     *
     * @param string $path The path where the directory will be created.
     * @param int $permissions The permissions to set for the directory (in octal).
     * @param bool $recursive Whether to create directories recursively.
     * @return bool Returns true on success, false on failure.
     */
    public function createDirectory(string $path, int $permissions = 0755, bool $recursive = true): bool
    {
        if (!file_exists($path)) {
            if (mkdir($path, $permissions, $recursive)) {
                echo "Directory created at {$path}\n";
                return true;
            } else {
                echo "Failed to create directory at {$path}\n";
                return false;
            }
        } else {
            echo "Directory already exists at {$path}\n";
            return true; // Consider existing directory as a non-error state
        }
    }

    /**
     * Change the permissions of an existing directory.
     *
     * @param string $path The path of the directory.
     * @param int $permissions The new permissions to set (in octal).
     * @return bool Returns true on success, false on failure.
     */
    public function changePermissions(string $path, int $permissions): bool
    {
        if (file_exists($path) && is_dir($path)) {
            if (chmod($path, $permissions)) {
                echo "Permissions changed for directory at {$path}\n";
                return true;
            } else {
                echo "Failed to change permissions for directory at {$path}\n";
                return false;
            }
        } else {
            echo "Directory does not exist at {$path}\n";
            return false;
        }
    }

    // Additional directory-related methods...
}
