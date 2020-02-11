<?php

return 'ssh -i /home/root/.ssh/id_rsa -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -o BatchMode=yes -o PasswordAuthentication=no -p 22 user@127.0.0.1 \'bash -se\' << \\EOF-KK-SSH
whoami
EOF-KK-SSH';
