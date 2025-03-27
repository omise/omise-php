<?php

interface OmiseHttpExecutorInterface {
  /**
   * @param  string $url
   * @param  string $requestMethod
   * @param  string $key
   * @param  array  $params
   *
   * @throws OmiseException
   *
   * @return string
   */
  public function execute($url, $requestMethod, $key, $params = null);
}
