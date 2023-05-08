<!-- readme -->

# [![Build Status](https://travis-ci.org/robertdebock/ansible-role-ntp.svg?branch=master)](https://travis-ci.org/robertdebock/ansible-role-ntp) [![Ansible Galaxy](https://img.shields.io/badge/galaxy-robertdebock.ntp-blue.svg)](https://galaxy.ansible.com/robertdebock/ntp)

Install and configure ntp, a daemon to keep your system time in sync.

## Requirements

- pip packages listed in [requirements.txt](

## Role Variables

Available variables are listed below, along with default values (see defaults/main.yml):

```

# The servers to use for time synchronization.
ntp_servers:
  - 0.pool.ntp.org
  - 1.pool.ntp.org
  - 2.pool.ntp.org
  - 3.pool.ntp.org


# The servers to use for time synchronization.

# The servers to use for time synchronization.
ntp_servers:
  - 0.pool.ntp.org
  - 1.pool.ntp.org
  - 2.pool.ntp.org
  - 3.pool.ntp.org

# The servers to use for time synchronization.
```
