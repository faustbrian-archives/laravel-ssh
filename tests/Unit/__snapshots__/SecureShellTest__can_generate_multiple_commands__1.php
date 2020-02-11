<?php

return 'ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -o BatchMode=yes -o PasswordAuthentication=no -p 22 user@example.com \'bash -se\' << \\EOF-KK-SSH
whoami
cd /var/log
EOF-KK-SSH';
