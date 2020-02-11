<?php

return 'scp -i /home/root/.ssh/id_rsa -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -o BatchMode=yes -o PasswordAuthentication=no -P 22 user@127.0.0.1 /home/root/source:/home/root/target';
