#!/usr/bin/env bash

chmod -R 777 ./tests/_output/
rm -r ./tests/_output/

    testType=$1
    testSuite=$2
    testCase=$3

    test_cmd="docker exec -ti makeagiftests_web_1 codecept run"

    if [[ -n "$testType" ]]; then
        test_cmd="$test_cmd $testType"

        if [[ -n "$testSuite" ]]; then
            test_cmd="$test_cmd $testSuite"

            if [[ -n "$testCase" ]]; then
                 test_cmd="$test_cmd:$testCase"
            fi
        fi
    fi

test_cmd="$test_cmd --steps"

echo $test_cmd
eval $test_cmd

exit 200