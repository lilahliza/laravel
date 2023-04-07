#!/bin/bash
# 设置为活动数据库



# php artisan command:test_env_server  --env=b43d45
# php artisan command:test_env_server  --env=4b3d45


# php artisan make:model ActivityLog -m  --env=duwbai
php artisan migrate  --env=duwbai
php artisan command:test_env_server  --env=duwbai
# 不能过度执行 rollback
# php artisan migrate:rollback  --env=duwbai
