#!/bin/bash
# 设置为活动数据库



php artisan command:test_env_server  --env=b43d45
php artisan command:test_env_server  --env=4b3d45

php artisan command:test_env_server  --env=duwbai
php artisan migrate  --env=duwbai
php artisan migrate:rollback  --env=duwbai
