#!/usr/bin/env bash

export HOST_NAME_1=tcp://open2-rongchang.internal.myalauda.cn:10608

PORT_80_TCP=${HOST_NAME_1}
#export PORT_80_TCP=ticket-system-689c664f6-s4bzn

SERVICE_TMP=${PORT_80_TCP#tcp://}
SERVICE_URL="http://${SERVICE_TMP}"

export SERVICE_TMP=${SERVICE_TMP%-*}
export SSO_ID_PREFIX=${SERVICE_TMP/-/.}

echo ${SERVICE_TMP}
echo ${SSO_ID_PREFIX}