<?hh // strict

// exn stands for extensible

class MyException extends Exception { }

function throw_exn(bool $b): void {
  if ($b) {
    throw new Exception('test');
  } else {
    throw new MyException('test2');
  }
}

function nus(bool $b): void {
  try {
    throw_exn($b);
  } catch (MyException $e) {
    // Can't dump the whole exception, since we don't output correct
    // file/line info
    //var_dump($e);
    var_dump($e->getMessage());
  } catch (Exception $e2) {
    //var_dump($e2);
    var_dump($e2->getMessage());
  } finally {
    echo "final.\n";
  }
}

function direct_1(): void {
  try {
    throw new Exception('hi');
  } catch (Exception $e) {
    var_dump($e->getMessage());
  }
}
function direct_2(): void {
  try {
    try {
      throw new Exception('hi');
    } finally {
      echo "cool\n";
    }
  } catch (Exception $e) {
  }
}


function test(): void {
  nus(true);
  nus(false);
  direct_1();
  direct_2();
}
